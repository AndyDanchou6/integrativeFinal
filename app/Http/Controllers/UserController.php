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
                'error' => 'Data not found'
            ];
        }

        return [
            'status' => 200,
            'message' => 'Data found',
            'data' => $users
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newUser = [
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => $request['password']
        ];

        $created = User::create($newUser);

        if (!$created) {
            return [
                'status' => 500,
                'error' => 'User Creation Failed'
            ];
        }

        return [
            'status' => 201,
            'message' => 'User Created Successfully'
        ];
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
                'error' => 'No Data Found'
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
