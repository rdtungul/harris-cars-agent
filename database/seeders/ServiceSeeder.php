<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\ServiceCategory;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ServiceCategory::pluck('id', 'slug');

        $services = [
            // Standard Maintenance
            [
                'category_slug'     => 'standard-maintenance',
                'title'             => 'Oil Change & Lube Service',
                'slug'              => 'oil-change-lube',
                'short_description' => 'Conventional, synthetic blend, or full synthetic oil changes with multi-point vehicle inspection, fluid top-off, and tire pressure check.',
                'description'       => "Keep your engine running at its peak with our comprehensive oil change service.\n\nWe offer:\n- Conventional Oil Change\n- Synthetic Blend Oil Change\n- Full Synthetic Oil Change\n- High Mileage Oil Change\n\nEvery oil change includes a complimentary multi-point vehicle inspection, topping off all fluids, and tire pressure adjustment. Our ASE Certified technicians use quality oil and filters to manufacturer specifications.",
                'price_range'       => 'Starting at $39.99',
                'duration'          => '30-45 minutes',
                'is_featured'       => true,
                'order'             => 1,
            ],
            [
                'category_slug'     => 'standard-maintenance',
                'title'             => 'Tire Rotation & Balancing',
                'slug'              => 'tire-rotation-balancing',
                'short_description' => 'Extend tire life and improve handling with professional tire rotation, balancing, and pressure adjustment every 5,000-7,500 miles.',
                'description'       => "Regular tire rotation is one of the most important maintenance services you can do. Rotating tires equalizes wear, extends tire life, and improves fuel economy.\n\nOur tire service includes:\n- Tire rotation (5-lug pattern or full rotation)\n- Wheel balancing\n- Tire pressure adjustment\n- Visual brake inspection\n- Tread depth check",
                'price_range'       => 'Starting at $19.99',
                'duration'          => '30-45 minutes',
                'is_featured'       => false,
                'order'             => 2,
            ],

            // Engine Service
            [
                'category_slug'     => 'engine-service',
                'title'             => 'Engine Diagnostic Service',
                'slug'              => 'engine-diagnostics',
                'short_description' => 'Advanced computerized diagnostics to accurately identify check engine lights, drivability issues, and engine performance problems.',
                'description'       => "Is your check engine light on? Don't ignore it. Our state-of-the-art diagnostic equipment can read fault codes from all major manufacturers and pinpoint the exact cause of your issue.\n\nOur diagnostic service includes:\n- Full OBD-II scan\n- Live data analysis\n- Visual engine inspection\n- Written estimate for recommended repairs\n\nWe use professional-grade diagnostic tools, not cheap code readers. Accurate diagnosis saves you time and money.",
                'price_range'       => 'Call for pricing',
                'duration'          => '1-2 hours',
                'is_featured'       => true,
                'order'             => 1,
            ],
            [
                'category_slug'     => 'engine-service',
                'title'             => 'Tune-Up Service',
                'slug'              => 'tune-up-service',
                'short_description' => 'Complete engine tune-up including spark plugs, air filter, fuel filter, PCV valve, and ignition system inspection to restore performance.',
                'description'       => "A complete tune-up restores fuel economy, power, and smooth operation to your engine.\n\nOur tune-up service typically includes:\n- Spark plug replacement\n- Air filter replacement\n- Fuel filter service\n- PCV valve inspection/replacement\n- Ignition system inspection\n- Fuel system cleaning\n\nService interval varies by vehicle — most modern vehicles need a tune-up every 30,000-100,000 miles depending on spark plug type.",
                'price_range'       => 'Starting at $89.99',
                'duration'          => '1-2 hours',
                'is_featured'       => false,
                'order'             => 2,
            ],

            // Heating & AC
            [
                'category_slug'     => 'heating-air-conditioning',
                'title'             => 'AC Recharge & Repair',
                'slug'              => 'ac-recharge-repair',
                'short_description' => 'Is your AC blowing warm air? We diagnose and repair AC systems including refrigerant recharge, compressor replacement, and leak detection.',
                'description'       => "Don't suffer through another hot summer. Our HVAC technicians will diagnose and repair your air conditioning system quickly.\n\nServices include:\n- AC system performance test\n- Refrigerant leak detection\n- R-134a or R-1234yf recharge\n- Compressor replacement\n- Condenser & evaporator service\n- Cabin air filter replacement\n\nWe service all makes and models. Most AC recharges can be completed same-day.",
                'price_range'       => 'Starting at $79.99',
                'duration'          => '1-3 hours',
                'is_featured'       => true,
                'order'             => 1,
            ],
            [
                'category_slug'     => 'heating-air-conditioning',
                'title'             => 'Heater & Cooling System Repair',
                'slug'              => 'heater-cooling-repair',
                'short_description' => 'Heater core replacement, coolant flush, thermostat replacement, radiator service, and water pump repair to keep your engine at the right temperature.',
                'description'       => "Your vehicle\'s cooling system is critical to engine health. Overheating can cause severe engine damage in minutes.\n\nOur cooling system services include:\n- Coolant flush and fill\n- Thermostat replacement\n- Radiator repair or replacement\n- Water pump replacement\n- Heater core service\n- Cooling fan diagnosis\n- Hose inspection and replacement\n\nWe recommend a coolant flush every 30,000-50,000 miles.",
                'price_range'       => 'Starting at $99.99',
                'duration'          => '1-4 hours',
                'is_featured'       => false,
                'order'             => 2,
            ],

            // Transmission
            [
                'category_slug'     => 'transmission-service',
                'title'             => 'Transmission Fluid Service',
                'slug'              => 'transmission-fluid-service',
                'short_description' => 'Automatic and manual transmission fluid flush and filter replacement to protect your transmission from wear and extend its life.',
                'description'       => "Transmission fluid is the lifeblood of your transmission. Old, burned fluid accelerates wear and leads to costly failures.\n\nOur transmission service includes:\n- Fluid drain and refill (or full flush)\n- Filter replacement (where applicable)\n- Pan gasket inspection\n- Transmission performance check\n\nMost vehicles need transmission service every 30,000-60,000 miles. Neglecting this service is one of the most common causes of expensive transmission failures.",
                'price_range'       => 'Starting at $149.99',
                'duration'          => '1-2 hours',
                'is_featured'       => true,
                'order'             => 1,
            ],
            [
                'category_slug'     => 'transmission-service',
                'title'             => 'Transmission Diagnosis & Repair',
                'slug'              => 'transmission-diagnosis-repair',
                'short_description' => 'Complete transmission diagnosis, repair, and rebuild services for slipping, shuddering, hard shifting, and other transmission problems.',
                'description'       => "Transmission problems rarely fix themselves. Our transmission technicians have the expertise to diagnose and repair all types of transmission issues.\n\nSymptoms we address:\n- Slipping or delayed engagement\n- Hard or erratic shifting\n- Transmission shudder\n- Fluid leaks\n- Grinding or shaking\n- Burning smell\n\nWe provide a written diagnosis and estimate before any repair work begins. Never a surprise bill.",
                'price_range'       => 'Call for pricing',
                'duration'          => 'Varies',
                'is_featured'       => false,
                'order'             => 2,
            ],

            // Exhaust & Suspension
            [
                'category_slug'     => 'exhaust-suspension',
                'title'             => 'Exhaust System Service',
                'slug'              => 'exhaust-service',
                'short_description' => 'Muffler replacement, catalytic converter service, exhaust pipe repair, and complete exhaust system inspection for all vehicles.',
                'description'       => "A properly functioning exhaust system is essential for performance, fuel economy, and emissions compliance.\n\nOur exhaust services include:\n- Exhaust system inspection\n- Muffler replacement\n- Catalytic converter service\n- Exhaust pipe repair or replacement\n- Oxygen sensor replacement\n- Exhaust manifold repair\n\nWe carry quality exhaust components for most domestic and foreign vehicles.",
                'price_range'       => 'Call for pricing',
                'duration'          => '1-3 hours',
                'is_featured'       => false,
                'order'             => 1,
            ],
            [
                'category_slug'     => 'exhaust-suspension',
                'title'             => 'Suspension & Steering Service',
                'slug'              => 'suspension-steering',
                'short_description' => 'Wheel alignment, shocks and struts, ball joints, tie rods, sway bar links, and complete suspension inspection for a smooth, safe ride.',
                'description'       => "Your suspension system affects handling, ride comfort, and tire wear. Worn suspension components are a safety issue.\n\nOur suspension services include:\n- Four-wheel alignment\n- Shocks and struts replacement\n- Ball joint inspection and replacement\n- Tie rod ends\n- Sway bar links and bushings\n- Control arms\n- Wheel bearing replacement\n\nSigns you need suspension work: vehicle pulls to one side, uneven tire wear, bumpy ride, or a clunking noise over bumps.",
                'price_range'       => 'Call for pricing',
                'duration'          => '1-4 hours',
                'is_featured'       => true,
                'order'             => 2,
            ],

            // Tires & Brakes
            [
                'category_slug'     => 'tires-brakes',
                'title'             => 'Brake Service & Repair',
                'slug'              => 'brake-service',
                'short_description' => 'Complete brake system service including pad and rotor replacement, brake fluid flush, caliper service, and ABS system diagnosis.',
                'description'       => "Your brakes are your most critical safety system. Don\'t delay brake service.\n\nOur brake services include:\n- Brake inspection\n- Brake pad replacement\n- Rotor resurfacing or replacement\n- Brake caliper service\n- Brake fluid flush\n- ABS system diagnosis\n- Emergency brake adjustment\n\nWarning signs: squealing, grinding, soft pedal, vehicle pulling during braking, or brake warning light. Call us immediately if you notice any of these signs.",
                'price_range'       => 'Starting at $89.99/axle',
                'duration'          => '1-3 hours',
                'is_featured'       => true,
                'order'             => 1,
            ],
            [
                'category_slug'     => 'tires-brakes',
                'title'             => 'New Tire Installation',
                'slug'              => 'tire-installation',
                'short_description' => 'New tire installation, mounting, balancing, and TPMS service. We carry competitive pricing on most tire brands and sizes.',
                'description'       => "Ready for new tires? We carry or can order most major tire brands.\n\nOur tire service includes:\n- Tire mounting and balancing\n- TPMS sensor service\n- Valve stem replacement\n- Old tire disposal\n- Post-installation inspection\n\nWe recommend checking tire tread depth monthly. Replace tires when tread reaches 2/32\". Don\'t wait until you have a blowout.",
                'price_range'       => 'Call for pricing',
                'duration'          => '45-90 minutes',
                'is_featured'       => false,
                'order'             => 2,
            ],
        ];

        foreach ($services as $data) {
            $categorySlug = $data['category_slug'];
            $categoryId   = $categories[$categorySlug] ?? null;

            if (! $categoryId) {
                $this->command->warn("Category not found: {$categorySlug}");
                continue;
            }

            unset($data['category_slug']);

            Service::updateOrCreate(
                ['slug' => $data['slug']],
                array_merge($data, [
                    'category_id' => $categoryId,
                    'is_active'   => true,
                ])
            );
        }

        $this->command->info('Services seeded: ' . count($services) . ' services created.');
    }
}
