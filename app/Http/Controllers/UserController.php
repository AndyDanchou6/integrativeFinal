<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        if ($users->isEmpty()) {
            return [
                'status' => 404,
                'message' => 'Data not found'
            ];
        }

        return [
            'status' => 200,
            'message' => 'Data found',
            'data' => $users
        ];
    }

    public function validate_user(Request $request)
    {
        try {
            $validated = Validator::make($request->all(), [
                'username' => 'required|string|max:255',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
                'phoneNo' => 'required|string',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($validated->fails()) {
                return response()->json([
                    'status' => 422,
                    'message' => $validated->errors()
                ]);
            }

            $exists = User::where('email', $request['email'])->get();

            if ($exists->isEmpty() == false) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Email Already Exists'
                ]);
            }

            return response()->json([
                'status' => 200,
                'message' => 'Data Validated',
                'data' => $request->all()
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $newUser = [
                'username' => $request['username'],
                'email' => $request['email'],
                'phoneNo' => $request['phoneNo'],
                'password' => Hash::make($request['password'])
            ];

            if ($request->hasFile('image')) {
                $pictureFile = $request->file('image')->store('images', 'images');

                $newUser['image'] = $pictureFile;
            }

            $created = User::create($newUser);

            if (!$created) {
                return response()->json([
                    'status' => 500,
                    'message' => 'User Creation Failed'
                ]);
            }

            return response()->json([
                'status' => 201,
                'message' => 'User Created Successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function search($key, $value)
    {
        $found = User::where($key, $value)->get();

        if ($found->isEmpty()) {
            return [
                'status' => 404,
                'message' => 'No Data Found'
            ];
        }

        $data = $found->toArray();
        return [
            'status' => 200,
            'message' => 'Data Found',
            'count' => $found->count(),
            'data' => $data
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
