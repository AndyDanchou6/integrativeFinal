<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if ($validated->fails()) {
            return [
                'status' => 422,
                'error' => $validated->errors()
            ];
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            $request->session()->put('user_id', Auth::user()->id);
            $request->session()->put('user_email', Auth::user()->email);

            $token = auth()->user()->createToken('31C073W')->plainTextToken;
            return [
                'status' => 200,
                'message' => 'Password and Email matched',
                'token' => $token
            ];
        }

        return [
            'status' => 400,
            'error' => 'Password and Email does not match'
        ];
    }

    public function logout(Request $request)
    {
        // Session::flush();
        // Auth::logout();

        $request->user()->tokens()->delete();
        $request->session()->regenerateToken();

        return [
            'status' => 200,
            'message' => 'Successfully logged out'
        ];
    }

    public function validate_user(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed'
        ]);

        if ($validated->fails()) {
            return [
                'status' => 422,
                'error' => $validated->errors()
            ];
        }

        $exists = User::where('email', $request['email'])->get();

        if ($exists->isEmpty() == false) {
            return [
                'status' => 400,
                'error' => 'Email Already Exists'
            ];
        }

        $data = [
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ];

        return [
            'status' => 200,
            'message' => 'Data Validated'
        ];
    }
}
