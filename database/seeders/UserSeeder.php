<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $email    = env('ADMIN_EMAIL', 'admin@harriscars.com');
        $password = env('ADMIN_PASSWORD', 'password');

        User::updateOrCreate(
            ['email' => $email],
            [
                'name'     => env('ADMIN_NAME', 'Harris Admin'),
                'password' => Hash::make($password),
                'role'     => 'admin',
            ]
        );

        $this->command->info("Admin user created: {$email}");
    }
}
