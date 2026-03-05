@extends('layouts.app')

@section('title', 'Customer Reviews')
@section('meta_description', 'Read what Harris Cars Service Center customers say about our auto repair service in Stallings, NC. 4.9 star average rating.')

@section('content')

{{-- Header --}}
<div class="bg-brand-dark py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-brand-primary font-semibold uppercase tracking-widest text-sm mb-2">Customer Feedback</p>
        <h1 class="font-display text-5xl sm:text-6xl text-white tracking-wider mb-4">CUSTOMER REVIEWS</h1>
        <div class="flex items-center justify-center gap-2 mb-2">
            <span class="text-yellow-500 text-3xl">★★★★★</span>
        </div>
        <p class="text-gray-400">
            <span class="text-white font-semibold text-xl">{{ number_format($averageRating, 1) }}</span>
            out of 5.0 &mdash; Based on {{ $totalReviews }} verified reviews
        </p>
    </div>
</div>

<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-4 gap-10">
            {{-- Sidebar: Rating Breakdown + Leave Review --}}
            <div class="lg:col-span-1 space-y-6">
                {{-- Rating Breakdown --}}
                <div class="bg-white rounded-lg border border-gray-200 p-5">
                    <h3 class="font-display text-lg text-brand-dark tracking-wider mb-4">RATING BREAKDOWN</h3>
                    @foreach(array_reverse(array_keys($ratingBreakdown)) as $stars)
                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-yellow-500 text-sm w-8">{{ str_repeat('★', $stars) }}</span>
                            <div class="flex-1 bg-gray-200 rounded-full h-2">
                                <div class="bg-yellow-400 rounded-full h-2" style="width: {{ $ratingBreakdown[$stars]['percent'] }}%"></div>
                            </div>
                            <span class="text-xs text-gray-500 w-6">{{ $ratingBreakdown[$stars]['count'] }}</span>
                        </div>
                    @endforeach
                </div>

                {{-- Leave a Review CTA --}}
                <div class="bg-brand-dark rounded-lg p-5 text-center">
                    <h3 class="font-display text-lg text-white tracking-wider mb-2">LEAVE A REVIEW</h3>
                    <p class="text-gray-400 text-xs mb-4">Was your experience at Harris Cars great? Tell us about it!</p>
                    <a href="{{ route('testimonials.index') }}#leave-review"
                       class="block bg-brand-primary hover:bg-[#003370] text-white px-4 py-2.5 text-sm font-semibold transition-colors">
                        Write a Review
                    </a>
                </div>

                {{-- Review Platforms --}}
                <div class="bg-white rounded-lg border border-gray-200 p-5">
                    <h4 class="font-semibold text-brand-dark text-sm mb-3">Also Review Us On:</h4>
                    <div class="space-y-2">
                        @if(setting('google_reviews_url'))
                            <a href="{{ setting('google_reviews_url') }}" target="_blank" rel="noopener"
                               class="flex items-center text-sm text-gray-600 hover:text-brand-primary transition-colors">
                                <span class="mr-2">G</span> Google Reviews
                            </a>
                        @endif
                        @if(setting('yelp_url'))
                            <a href="{{ setting('yelp_url') }}" target="_blank" rel="noopener"
                               class="flex items-center text-sm text-gray-600 hover:text-brand-primary transition-colors">
                                <span class="mr-2">Y</span> Yelp
                            </a>
                        @endif
                        @if(setting('facebook_url'))
                            <a href="{{ setting('facebook_url') }}" target="_blank" rel="noopener"
                               class="flex items-center text-sm text-gray-600 hover:text-brand-primary transition-colors">
                                <span class="mr-2">f</span> Facebook
                            </a>
                        @endif
                        <a href="https://www.surecritic.com" target="_blank" rel="noopener"
                           class="flex items-center text-sm text-gray-600 hover:text-brand-primary transition-colors">
                            <span class="mr-2">SC</span> SureCritic
                        </a>
                    </div>
                </div>
            </div>

            {{-- Reviews Grid --}}
            <div class="lg:col-span-3">
                @if($testimonials->isNotEmpty())
                    <div class="grid sm:grid-cols-2 gap-5">
                        @foreach($testimonials as $review)
                            <div class="bg-white rounded-lg p-6 border border-gray-200 hover:border-brand-primary transition-colors relative">
                                <div class="absolute top-4 right-4 text-gray-100 font-display text-5xl leading-none select-none">"</div>
                                <div class="flex items-center mb-1">
                                    <span class="text-yellow-500 text-base">
                                        @for($i = 0; $i < $review->rating; $i++)★@endfor
                                        @for($i = $review->rating; $i < 5; $i++)<span class="text-gray-300">☆</span>@endfor
                                    </span>
                                    @if($review->source !== 'website')
                                        <span class="ml-2 text-xs text-gray-400 border border-gray-200 px-1.5 py-0.5 rounded">via {{ ucfirst($review->source) }}</span>
                                    @endif
                                </div>
                                <p class="text-gray-600 text-sm leading-relaxed my-3 italic relative z-10">"{{ $review->review_excerpt }}"</p>
                                <div class="flex items-center space-x-3 border-t border-gray-100 pt-3 mt-auto">
                                    <div class="w-9 h-9 bg-brand-primary rounded-full flex items-center justify-center flex-shrink-0">
                                        <span class="text-white font-bold text-xs">{{ $review->initials }}</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-brand-dark text-sm">{{ $review->customer_name }}</p>
                                        @if($review->customer_location)
                                            <p class="text-gray-400 text-xs">{{ $review->customer_location }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $testimonials->links() }}
                    </div>
                @else
                    <div class="text-center py-20 bg-white rounded-lg border border-gray-200">
                        <div class="text-6xl mb-4">⭐</div>
                        <h3 class="font-display text-2xl text-brand-dark tracking-wider mb-2">NO REVIEWS YET</h3>
                        <p class="text-gray-500">Be the first to leave a review!</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Leave Review Form --}}
        <div id="leave-review" class="mt-16 bg-white rounded-lg border border-gray-200 p-8 max-w-2xl mx-auto">
            <h2 class="font-display text-3xl text-brand-dark tracking-wider mb-2">SHARE YOUR EXPERIENCE</h2>
            <p class="text-gray-500 text-sm mb-6">Your review helps other customers and helps us improve. Thank you!</p>

            @if(setting('zoho_review_form_embed'))
                {!! setting('zoho_review_form_embed') !!}
            @else
                <form method="POST" action="{{ route('testimonials.store') }}" x-data="{ rating: {{ old('rating', 5) }} }">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Your Name <span class="text-brand-primary">*</span></label>
                            <input type="text" name="customer_name" value="{{ old('customer_name') }}" required
                                   class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                            <input type="text" name="customer_location" value="{{ old('customer_location') }}"
                                   placeholder="e.g. Stallings, NC"
                                   class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                        </div>
                    </div>
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Your Rating <span class="text-brand-primary">*</span></label>
                        <div class="flex items-center gap-2">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" @click="rating = {{ $i }}"
                                        :class="rating >= {{ $i }} ? 'text-yellow-500' : 'text-gray-300'"
                                        class="text-3xl transition-colors hover:text-yellow-400">★</button>
                            @endfor
                            <span class="text-sm text-gray-500 ml-2" x-text="rating + '/5'"></span>
                        </div>
                        <input type="hidden" name="rating" :value="rating">
                    </div>
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Your Review <span class="text-brand-primary">*</span></label>
                        <textarea name="review" rows="4" required minlength="10"
                                  placeholder="Tell us about your experience..."
                                  class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary resize-none">{{ old('review') }}</textarea>
                    </div>
                    <button type="submit"
                            class="w-full bg-brand-primary hover:bg-[#003370] text-white py-3 font-display text-lg tracking-wider transition-colors">
                        SUBMIT REVIEW
                    </button>
                    <p class="text-xs text-gray-400 text-center mt-2">Reviews are approved before publishing.</p>
                </form>
            @endif
        </div>
    </div>
</section>

@endsection
