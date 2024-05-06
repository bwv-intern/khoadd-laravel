<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function attemptLogin(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validation->fails()) {
            return view('login', [
                'previousEmail' => $request->all()['email'],
                'errorMessage' => $validation->errors()->first(),
            ]);
        }

        $validated = $validation->validated();

        // error_log(join(', ', $validation->validated()));
        $isLoginOK = Auth::attempt($validated);

        if (!$isLoginOK) {
            return view('login', [
                'previousEmail' => $validated['email'],
                'errorMessage' => 'Incorrect email or password',
            ]);
        }

        return redirect('home');
    }

    public function attemptRegister(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|unique:users|string|email',
            'name' => 'required|string',
            'password' => ['required', 'string', 'confirmed', Password::min(8)],
        ]);

        if ($validation->fails()) {
            return view('register', [
                'previousEmail' => $request->all()['email'],
                'previousName' => $request->all()['name'],
                'errorMessage' => $validation->errors()->first(),
            ]);
        }

        $validated = $validation->validated();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        Auth::login($user);

        return redirect('home');
    }

    public function viewLogin(Request $request)
    {
        if (Auth::check()) {
            return redirect('home');
        }

        return view('login');
    }

    public function viewRegister(Request $request)
    {
        if (Auth::check()) {
            return redirect('home');
        }

        return view('register');
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
        }

        return redirect('home');
    }
}
