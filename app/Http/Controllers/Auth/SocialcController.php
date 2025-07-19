<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SocialcController extends Controller
{
    // Redirect user to the social provider's authentication page
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // Handle callback from the social provider
    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            // Failed to get user info, redirect to login with error
            return redirect()->route('login')->withErrors('Unable to login using ' . $provider . '. Please try again.');
        }

        // Check if user already exists
        $user = User::where('provider_id', $socialUser->getId())
                    ->where('provider', $provider)
                    ->first();

        if (!$user) {
            // If user does not exist, create new
            $user = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'email' => $socialUser->getEmail(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'password' => bcrypt(Str::random(16)), // Random password
            ]);
        }

        // Login the user
        Auth::login($user, true);

        // Redirect to intended page or homepage
        return redirect()->intended('/');
    }
}
