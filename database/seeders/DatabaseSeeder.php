<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SettingsSeeder::class,
            ServiceCategorySeeder::class,
            ServiceSeeder::class,
            TestimonialSeeder::class,
            SpecialsSeeder::class,
        ]);

        $this->command->info('Harris Cars Service Center seeded successfully!');
        $this->command->line('  Admin: admin@harriscars.com / password');
        $this->command->line('  URL:   http://localhost:8080/admin');
    }
}
