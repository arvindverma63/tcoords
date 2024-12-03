<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Support\Facades\Redirect;

class LinkedInController extends Controller
{
    /**
     * Redirect to LinkedIn for authentication
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToLinkedIn()
    {
        Log::info('Redirecting user to LinkedIn for authentication.');

        return Socialite::driver('linkedin')->redirect();
    }

    /**
     * Handle LinkedIn callback and process the user's data
     *
     * @return \Illuminate\Http\Response
     */
    public function handleLinkedInCallback()
    {
        try {
            Log::info('Handling LinkedIn callback.');

            // Retrieve user information from LinkedIn using Socialite
            $linkedinUser = Socialite::driver('linkedin')->stateless()->user();
            Log::info('LinkedIn user data retrieved: ' . json_encode($linkedinUser));

            $baseUrl = env('API_BASE_URL');

            // Check if the user already exists by LinkedIn ID
            $checkUserResponse = Http::get($baseUrl . '/getUser/' . $linkedinUser->getId());
            Log::info('Checked if user exists in the system. Status: ' . $checkUserResponse->status());

            // If the user doesn't exist, register them
            if ($checkUserResponse->status() === 404) {
                Log::info('User not found, registering new user with LinkedIn data.');

                // Register the user via API if not found
                $registerUserResponse = Http::post($baseUrl . '/register', [
                    'name' => $linkedinUser->getName(),
                    'email' => $linkedinUser->getEmail(),
                    'linkedin_id' => $linkedinUser->getId(),
                    'password' => bcrypt('default-password'), // You should ideally handle passwords securely
                ]);

                // Check if registration is successful
                if ($registerUserResponse->successful()) {
                    Log::info('User registered successfully: ' . $linkedinUser->getName());

                    // Store token in session after registration
                    $responseData = $registerUserResponse->json();
                    Session::put('token', $responseData['token']);
                } else {
                    Log::error('Failed to register user: ' . $linkedinUser->getName());
                    return redirect('/')->withErrors('Unable to register your LinkedIn account. Please try again.');
                }
            } else {
                Log::info('User already exists. Logging in user.');

                // If user exists, ensure the token is retrieved
                $responseData = $checkUserResponse->json();
                Session::put('token', $responseData['token']);
            }

            // Redirect the user to their intended dashboard or a specific route
            return redirect()->intended('/signIn');
        } catch (\Exception $e) {
            Log::error('Error during LinkedIn login: ' . $e->getMessage());

            // Handle exceptions and redirect with an error message
            return redirect('/login')->withErrors('Unable to login with LinkedIn. Please try again.');
        }
    }
}
