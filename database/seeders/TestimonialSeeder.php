<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'customer_name'     => 'Michael Thompson',
                'customer_location' => 'Stallings, NC',
                'customer_vehicle'  => '2017 Honda Accord',
                'rating'            => 5,
                'review'            => 'Harris Cars has been my go-to shop for years. They are honest, fair with pricing, and always explain what needs to be done without pressuring you into unnecessary repairs. My whole family uses them now. I would not take my vehicles anywhere else.',
                'is_approved'       => true,
                'is_featured'       => true,
                'source'            => 'google',
            ],
            [
                'customer_name'     => 'Sarah Williams',
                'customer_location' => 'Waxhaw, NC',
                'customer_vehicle'  => '2020 Toyota Camry',
                'rating'            => 5,
                'review'            => 'Brought my car in for a brake issue I was nervous about. They diagnosed it quickly, gave me a fair quote, and had it done same day. The waiting area is clean and comfortable and they even have free WiFi. Highly recommend Harris Cars!',
                'is_approved'       => true,
                'is_featured'       => true,
                'source'            => 'google',
            ],
            [
                'customer_name'     => 'James Patterson',
                'customer_location' => 'Indian Trail, NC',
                'customer_vehicle'  => '2015 Ford F-150',
                'rating'            => 5,
                'review'            => 'Best mechanic shop I have ever been to. The team is knowledgeable, professional, and genuinely cares about doing the job right. They caught an issue that another shop completely missed. I will never go anywhere else.',
                'is_approved'       => true,
                'is_featured'       => true,
                'source'            => 'surecritic',
            ],
            [
                'customer_name'     => 'Maria Garcia',
                'customer_location' => 'Monroe, NC',
                'customer_vehicle'  => '2019 BMW 3 Series',
                'rating'            => 5,
                'review'            => 'As a woman, I was nervous about finding a trustworthy mechanic. Harris Cars was recommended by a friend and I am so glad I went. They were transparent about everything, showed me what was wrong, and did not try to upsell me on things I did not need.',
                'is_approved'       => true,
                'is_featured'       => false,
                'source'            => 'yelp',
            ],
            [
                'customer_name'     => 'David Chen',
                'customer_location' => 'Stallings, NC',
                'customer_vehicle'  => '2016 Mazda CX-5',
                'rating'            => 5,
                'review'            => 'Quick, honest, and excellent work. My AC went out on the hottest day of the year and they had me back on the road same afternoon. Fair price and great customer service. This is my shop from now on.',
                'is_approved'       => true,
                'is_featured'       => false,
                'source'            => 'facebook',
            ],
            [
                'customer_name'     => 'Robert Johnson',
                'customer_location' => 'Mint Hill, NC',
                'customer_vehicle'  => '2018 Chevrolet Silverado',
                'rating'            => 5,
                'review'            => 'I have been going to Harris Cars for 3 years. They have serviced four different vehicles for my family. Consistently great work, fair prices, and they always get my truck done when they say they will. Trustworthy and professional every time.',
                'is_approved'       => true,
                'is_featured'       => false,
                'source'            => 'surecritic',
            ],
            [
                'customer_name'     => 'Jennifer Martinez',
                'customer_location' => 'Indian Trail, NC',
                'customer_vehicle'  => '2021 Subaru Outback',
                'rating'            => 4,
                'review'            => 'Very professional shop. They were honest about what my car needed and gave me a fair timeline. Slight wait for a loaner but they communicated well throughout. Overall great experience and I will be back.',
                'is_approved'       => true,
                'is_featured'       => false,
                'source'            => 'website',
            ],
            [
                'customer_name'     => 'Tom Bradley',
                'customer_location' => 'Weddington, NC',
                'customer_vehicle'  => '2014 Mercedes-Benz C300',
                'rating'            => 5,
                'review'            => 'Harris Cars is one of the few independent shops that I trust with my Mercedes. Dealer wanted $900 for a service Harris Cars did for $380 — same quality parts, same result. These guys know what they are doing and they are honest about it.',
                'is_approved'       => true,
                'is_featured'       => false,
                'source'            => 'google',
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }

        $this->command->info('Testimonials seeded: ' . count($testimonials) . ' reviews created.');
    }
}
