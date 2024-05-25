<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'username' => 'Master Danchou',
                'email' => 'danchou@admin.me',
                'password' => Hash::make('andydanch0u'),
                'role' => 1,
                'phoneNo' => '09307696919',
                'otpCode' => '121402'
            ],
            [
                'username' => 'Master Danchou2',
                'email' => 'danchou2@admin.me',
                'password' => Hash::make('andydanch0u'),
                'role' => 1,
                'phoneNo' => '09307696919',
                'otpCode' => '121402'
            ]
        ];

        foreach ($admins as $admin) {
            User::create($admin);
        }
    }
}
