<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use PgSql\Lob;

class LinkedinController extends Controller
{
  public function handleLinkedinAuthentication()
  {

    // New OpenID implementation
    //dd(Socialite::driver('linkedin-openid')->scopes(['openid', 'profile', 'email', 'w_member_social']));

    return Socialite::driver('linkedin-openid')->scopes(['openid', 'profile', 'email', 'w_member_social'])->redirect();
  }

  public function handleLinkedInCallback()
{
    try {
        Log::info('Handling LinkedIn callback.');

        // The user must be redirected back with a 'code' parameter
        $linkedinUser = Socialite::driver('linkedin-openid')
            ->stateless()
            ->user();

        Log::info('LinkedIn user data retrieved: ' . json_encode($linkedinUser));

        $baseUrl = env('API_BASE_URL');  // Your backend API base URL

        // Check if the user already exists
        $checkUserResponse = Http::get($baseUrl . '/getUser/' . $linkedinUser->getId());
        Log::info('Checked if user exists in the system. Status: ' . $checkUserResponse->status());

        if ($checkUserResponse->status() === 404) {
            // Register new user
            Log::info('User not found, registering new user with LinkedIn data.');
            $registerUserResponse = Http::post($baseUrl . '/register', [
                'name' => $linkedinUser->getName(),
                'email' => $linkedinUser->getEmail(),
                'linkedin_id' => $linkedinUser->getId(),
                'password' => bcrypt('default-password'),
            ]);

            if ($registerUserResponse->successful()) {
                Log::info('User registered successfully: ' . $linkedinUser->getName());
                $responseData = $registerUserResponse->json();
                Session::put('token', $responseData['token']);
            } else {
                Log::error('Failed to register user: ' . $linkedinUser->getName());
                return redirect('/')->withErrors('Unable to register your LinkedIn account. Please try again.');
            }
        } else {
            Log::info('User already exists. Logging in user.');
            $responseData = $checkUserResponse->json();
            Session::put('token', $responseData['token']);
        }

        // Redirect to the intended page after login
        return redirect()->intended('/dashboard');
    } catch (\Exception $e) {
        Log::error('Error during LinkedIn login: ' . $e->getMessage());
        return redirect('/')->withErrors('Unable to login with LinkedIn. Please try again.');
    }
}

}
