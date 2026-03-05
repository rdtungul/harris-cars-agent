<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@harriscars.com'],
            [
                'name'     => 'Harris Admin',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );

        $this->command->info('Admin user created: admin@harriscars.com / password');
    }
}
