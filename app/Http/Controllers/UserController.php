<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Register user

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign default data to the user (could be trade-related data or other)
        $this->assignUserData($user);

        // Log the user in
        Auth::login($user);

        return redirect()->route('layouts.app');

    }

    // Log in user
    public function login(Request $request)
    {
        // Validate the input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in with or without the "remember me" feature
        if (Auth::attempt($credentials, $request->has('remember'))) {
            // Regenerate the session to avoid session fixation attacks
            $request->session()->regenerate();

            // Redirect to the app or the intended page after successful login
            return redirect()->route('layouts.app');
        }

        // If login fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    // Log out user
    public function logout(Request $request)
    {
        // Logout the user
        Auth::logout();

        // Invalidate the session data
        $request->session()->invalidate();

        // Regenerate the CSRF token
        $request->session()->regenerateToken();

        // Redirect to the welcome page
        return redirect('/welcome');
    }

    // Method to assign initial data (such as trades, balance, etc.)
    protected function assignUserData(User $user)
    {
        // Assign data (for example, creating a default trade or balance record)
        // This can be customized as per your business logic
        // For example:
        // $user->trades()->create([...]);
        // $user->balance()->create([...]);

        // For demonstration, we'll just log it for now:
        \Log::info('Assigned default data to user: ' . $user->id);
    }

    // Show the registration form
    public function showRegisterForm()
    {
        return view('auth.register');  // Return the register view
    }

    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');  // Return the login view
    }
}

