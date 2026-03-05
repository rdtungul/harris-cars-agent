<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Special;
use Carbon\Carbon;

class SpecialsSeeder extends Seeder
{
    public function run(): void
    {
        $specials = [
            [
                'title'         => 'Oil Change Special',
                'description'   => 'Full synthetic oil change with multi-point inspection, fluid top-off, and tire pressure adjustment.',
                'discount_text' => '$10 OFF',
                'original_price'=> '$59.99',
                'sale_price'    => '$49.99',
                'valid_until'   => Carbon::now()->addMonths(3)->toDateString(),
                'is_active'     => true,
                'order'         => 1,
            ],
            [
                'title'         => 'Brake Special',
                'description'   => 'Front or rear brake pad and rotor service. Includes brake fluid level check and caliper inspection.',
                'discount_text' => '$25 OFF',
                'original_price'=> '$149.99',
                'sale_price'    => '$124.99',
                'valid_until'   => Carbon::now()->addMonths(2)->toDateString(),
                'is_active'     => true,
                'order'         => 2,
            ],
            [
                'title'         => 'AC Check & Recharge',
                'description'   => 'Beat the summer heat! AC system performance test and refrigerant top-off. Leak detection included.',
                'discount_text' => '$15 OFF',
                'original_price'=> '$99.99',
                'sale_price'    => '$84.99',
                'valid_until'   => Carbon::now()->addMonths(4)->toDateString(),
                'is_active'     => true,
                'order'         => 3,
            ],
        ];

        foreach ($specials as $special) {
            Special::create($special);
        }

        $this->command->info('Specials seeded: ' . count($specials) . ' offers created.');
    }
}
