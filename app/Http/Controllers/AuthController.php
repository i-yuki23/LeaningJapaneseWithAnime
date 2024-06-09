<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use PharIo\Manifest\Email;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'username' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:3', 'confirmed']
        ]);

        // Register the user
        $user = User::create($fields);

        // Login
        Auth::login($user);

        event(new Registered($user));

        // Redirect
        return redirect()->route('dashboard');
    }

    public function verifyNotice() {
        return view('auth.verify-email');
    }

    public function VerifyEmail(EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->route('dashboard');
    }

    public function verifyHandler(Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required']
        ]);
        // Login
        if (!Auth::attempt($fields, $request->remember)) {
            return back()->withErrors([
                'failed' => 'The provided credentials do not match our records.'
            ]);
        }
        // Redirect
        return redirect()->intended('/dashboard');
    }

    public function logout(Request $request) {
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();
        // Regenerate the CSRF token
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
