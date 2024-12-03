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
    const LINKEDIN_TYPE = 'linkedin';
    public function redirectToLinkedIn()
    {
        return Socialite::driver(static::LINKEDIN_TYPE)->redirect();
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

            // Get the code parameter from the request
            $code = request('code');
            $state = request('state');

            // Verify the state matches the one you generated earlier for CSRF protection

            // Get the access token
            $accessTokenResponse = Http::post('https://www.linkedin.com/oauth/v2/accessToken', [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => env('LINKEDIN_REDIRECT_URI'), // Same redirect URI used in the authorization URL
                'client_id' => env('LINKEDIN_CLIENT_ID'), // Your LinkedIn app client ID
                'client_secret' => env('LINKEDIN_CLIENT_SECRET'), // Your LinkedIn app client secret
            ]);

            if ($accessTokenResponse->successful()) {
                $accessToken = $accessTokenResponse->json()['access_token'];

                // Now, you can use the access token to fetch user information from LinkedIn
                $linkedinUserResponse = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $accessToken,
                ])->get('https://api.linkedin.com/v2/me');

                // Handle the user data
                $linkedinUser = $linkedinUserResponse->json();

                Log::info('LinkedIn user data retrieved: ' . json_encode($linkedinUser));

                // Check if the user exists in your system
                $baseUrl = env('API_BASE_URL');
                $checkUserResponse = Http::get($baseUrl . '/getUser/' . $linkedinUser['id']);

                if ($checkUserResponse->status() === 404) {
                    // Register new user
                    $registerUserResponse = Http::post($baseUrl . '/register', [
                        'name' => $linkedinUser['localizedFirstName'] . ' ' . $linkedinUser['localizedLastName'],
                        'email' => $linkedinUser['emailAddress'], // Ensure you're fetching the correct email field
                        'linkedin_id' => $linkedinUser['id'],
                        'password' => bcrypt('default-password'), // Handle this securely
                    ]);

                    if ($registerUserResponse->successful()) {
                        $responseData = $registerUserResponse->json();
                        Session::put('token', $responseData['token']);
                    }
                } else {
                    // User exists, log them in
                    $responseData = $checkUserResponse->json();
                    Session::put('token', $responseData['token']);
                }

                return redirect()->intended('/dashboard');
            } else {
                Log::error('Failed to retrieve access token: ' . $accessTokenResponse->body());
                return redirect('/')->withErrors('Unable to login with LinkedIn. Please try again.');
            }
        } catch (\Exception $e) {
            Log::error('Error during LinkedIn login: ' . $e->getMessage());
            return redirect('/')->withErrors('Unable to login with LinkedIn. Please try again.');
        }
    }
}
