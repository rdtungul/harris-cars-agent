@extends('layouts.app')

@section('title', 'Current Specials & Coupons')
@section('meta_description', 'Save money on auto repairs with Harris Cars Service Center specials and coupons. Serving Stallings, NC and the greater Charlotte area.')

@section('content')

<div class="bg-brand-dark py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="font-display text-5xl sm:text-6xl text-white tracking-wider mb-4">CURRENT SPECIALS</h1>
        <p class="text-gray-400">Save on quality auto service. Print or mention these specials when you schedule.</p>
    </div>
</div>

<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($specials->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @foreach($specials as $special)
                    <div class="relative bg-white border-2 border-brand-primary rounded-lg overflow-hidden">
                        {{-- Scissor dashed cut line --}}
                        <div class="absolute top-0 left-0 right-0 h-1 border-b-2 border-dashed border-brand-primary"></div>

                        @if($special->discount_text)
                            <div class="bg-brand-primary text-white text-center py-2">
                                <span class="font-display text-3xl tracking-wider">{{ $special->discount_text }}</span>
                            </div>
                        @endif

                        <div class="p-6">
                            <h3 class="font-display text-2xl text-brand-dark tracking-wider mb-2">{{ strtoupper($special->title) }}</h3>
                            @if($special->description)
                                <p class="text-gray-500 text-sm mb-4 leading-relaxed">{{ $special->description }}</p>
                            @endif

                            @if($special->sale_price)
                                <div class="flex items-baseline gap-3 mb-4">
                                    @if($special->original_price)
                                        <span class="text-gray-400 line-through text-base">{{ $special->original_price }}</span>
                                    @endif
                                    <span class="text-brand-primary font-bold text-3xl">{{ $special->sale_price }}</span>
                                </div>
                            @endif

                            @if($special->coupon_code)
                                <div class="bg-gray-50 border border-dashed border-gray-300 rounded p-3 mb-4 text-center">
                                    <p class="text-xs text-gray-500 mb-1">Coupon Code</p>
                                    <p class="font-bold text-brand-dark text-lg tracking-widest">{{ $special->coupon_code }}</p>
                                </div>
                            @endif

                            @if($special->valid_until)
                                <p class="text-xs text-gray-400 mb-4">
                                    Expires: <strong>{{ $special->valid_until->format('F j, Y') }}</strong>
                                </p>
                            @endif

                            <a href="{{ route('appointments.create') }}"
                               class="block bg-brand-primary hover:bg-[#003370] text-white text-center px-5 py-3 font-display text-lg tracking-wider transition-colors">
                                REDEEM THIS SPECIAL
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-lg border border-gray-200 mb-12">
                <div class="font-display text-6xl text-gray-200 mb-4">%</div>
                <h3 class="font-display text-2xl text-brand-dark tracking-wider mb-2">NO ACTIVE SPECIALS</h3>
                <p class="text-gray-500 mb-6">Check back soon! We regularly offer discounts on popular services.</p>
                <a href="{{ route('contact') }}" class="text-brand-primary font-semibold hover:text-[#003370] transition-colors">
                    Contact us for pricing &rarr;
                </a>
            </div>
        @endif

        {{-- Disclaimer --}}
        <div class="bg-white border border-gray-200 rounded-lg p-6 text-center">
            <p class="text-gray-500 text-xs">
                * Specials valid at Harris Cars Service Center, 2023 Richard Baker Dr, Stallings, NC 28104. Cannot be combined with other offers. Present coupon at time of service write-up. Valid on most vehicles. Restrictions may apply. Call for details.
            </p>
            <a href="tel:{{ format_phone(site_phone()) }}" class="text-brand-primary font-semibold text-sm mt-2 inline-block hover:text-[#003370] transition-colors">
                {{ site_phone() }}
            </a>
        </div>
    </div>
</section>

@endsection
