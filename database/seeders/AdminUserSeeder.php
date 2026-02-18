<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@celekki.org'],
            [
                'name' => 'Lekki Admin',
                'password' => Hash::make('admin12345'), // Change this after login
                'email_verified_at' => now(),
            ]
        );
    }
}
