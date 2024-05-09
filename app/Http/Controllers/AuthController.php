<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash, Validator};
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function submitLogin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $isLoginOK = Auth::attempt($validated);

        if (!$isLoginOK) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['auth-validation' => 'Incorrect username or password.']);
        }

        return redirect('home');
    }

    public function submitRegister(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:users|string|email',
            'name' => 'required|string',
            'password' => ['required', 'string', 'confirmed', Password::min(8)],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        Auth::login($user);

        return redirect('home');
    }

    public function viewLogin(Request $request)
    {
        // if (Auth::check()) {
        //     return redirect('home');
        // }

        return view('login');
    }

    public function viewRegister(Request $request)
    {
        // if (Auth::check()) {
        //     return redirect('home');
        // }

        return view('register');
    }

    public function submitLogout(Request $request)
    {
        // if (Auth::check()) {
        //     Auth::logout();
        // }
        Auth::logout();

        return redirect('home');
    }

    public function viewProfile(Request $request) {
        if (!Auth::check()) {
            return redirect('home');
        }

        $user = Auth::user();
        $elapsedDays = $user->created_at->diff(Carbon::now())->days;
        $currentTime = Carbon::now()->toISOString();
        return view('user.profile', compact('user', 'elapsedDays', 'currentTime'));
    }
}
