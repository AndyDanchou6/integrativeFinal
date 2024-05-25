<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validated = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string'
            ]);

            if ($validated->fails()) {
                return response()->json([
                    'status' => 422,
                    'message' => $validated->errors()
                ]);
            }

            $emailExists = User::where('email', $request->email)->first();

            if (!$emailExists) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Invalid email address'
                ]);
            }

            $passwordMatched = Hash::check($request->password, $emailExists->password);

            if (!$passwordMatched) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Incorrect password'
                ]);
            }

            $otpCode = rand(100000, 999999);

            // $otpSent = Http::asForm()->post(config('services.semaphore.uri'), [
            //     'number' => $emailExists->phoneNo,
            //     'apikey' => config('services.semaphore.key'),
            //     'message' => 'This is your OTP code for verification. ' . $otpCode
            // ]);

            // if (!$otpSent) {
            //     return response()->json([
            //         'status' => 500,
            //         'message' => 'OTP not sent'
            //     ]);
            // }

            $emailExists->otpCode = $otpCode;
            $emailExists->save();

            $data = [
                'email' => $request->email,
                'password' => $request->password
            ];

            return response()->json([
                'status' => 200,
                'message' => 'Valid Request',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function verifyOtp(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if ($request->otpCode != $user->otpCode) {
                return response()->json([
                    'status' => 400,
                    'message' => "OTP does not match"
                ]);
            }

            $token = $user->createToken('31C073W')->plainTextToken;

            return response()->json([
                'status' => 200,
                'message' => 'Token Created',
                'token' => $token
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function logout(Request $request)
    {
        try {
            // $user = User::where('email', $request->email);

            // $user->tokens()->delete();

            $request->user()->currentAccessToken()->delete();
            $request->session()->regenerateToken();

            return response()->json([
                'status' => 200,
                'message' => 'Successfully logged out'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }
}
