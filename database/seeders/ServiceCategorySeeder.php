<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;

class ServiceCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name'        => 'Standard Maintenance',
                'slug'        => 'standard-maintenance',
                'description' => 'Routine maintenance services to keep your vehicle running smoothly and prevent costly repairs.',
                'icon'        => 'wrench',
                'order'       => 1,
            ],
            [
                'name'        => 'Engine Service',
                'slug'        => 'engine-service',
                'description' => 'Comprehensive engine diagnostics, repair, and performance services for all makes and models.',
                'icon'        => 'engine',
                'order'       => 2,
            ],
            [
                'name'        => 'Heating & Air Conditioning',
                'slug'        => 'heating-air-conditioning',
                'description' => 'Full HVAC system diagnosis, repair, and service to keep you comfortable in any weather.',
                'icon'        => 'thermometer',
                'order'       => 3,
            ],
            [
                'name'        => 'Transmission Service',
                'slug'        => 'transmission-service',
                'description' => 'Automatic and manual transmission maintenance, repair, and rebuild services.',
                'icon'        => 'gear',
                'order'       => 4,
            ],
            [
                'name'        => 'Exhaust & Suspension',
                'slug'        => 'exhaust-suspension',
                'description' => 'Exhaust system repair and complete suspension service for a smooth, safe ride.',
                'icon'        => 'suspension',
                'order'       => 5,
            ],
            [
                'name'        => 'Tires & Brakes',
                'slug'        => 'tires-brakes',
                'description' => 'Complete tire and brake services including installation, rotation, balancing, and repair.',
                'icon'        => 'tire',
                'order'       => 6,
            ],
        ];

        foreach ($categories as $category) {
            ServiceCategory::updateOrCreate(
                ['slug' => $category['slug']],
                array_merge($category, ['is_active' => true])
            );
        }

        $this->command->info('Service categories seeded.');
    }
}
