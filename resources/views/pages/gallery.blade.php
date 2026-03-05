@extends('layouts.app')

@section('title', 'Photo Gallery')
@section('meta_description', 'See photos of Harris Cars Service Center in Stallings, NC. Our facility, team, and before & after repair photos.')

@section('content')

<div class="bg-brand-dark py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="font-display text-5xl sm:text-6xl text-white tracking-wider mb-4">GALLERY</h1>
        <p class="text-gray-400">Take a look inside our shop and see our work in action.</p>
    </div>
</div>

<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Category Filter --}}
        <div class="flex flex-wrap justify-center gap-3 mb-10">
            <a href="{{ route('gallery') }}"
               class="px-5 py-2 text-sm font-medium rounded transition-colors {{ $category === 'all' ? 'bg-brand-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                All Photos
            </a>
            @foreach($categories as $key => $label)
                <a href="{{ route('gallery', ['category' => $key]) }}"
                   class="px-5 py-2 text-sm font-medium rounded transition-colors {{ $category === $key ? 'bg-brand-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        {{-- Gallery Grid --}}
        @if($images->isNotEmpty())
            <div class="columns-2 md:columns-3 lg:columns-4 gap-3 space-y-3" x-data="lightbox()">
                @foreach($images as $image)
                    <div class="break-inside-avoid cursor-pointer" @click="open('{{ $image->image_url }}', '{{ addslashes($image->alt) }}')">
                        <img src="{{ $image->image_url }}"
                             alt="{{ $image->alt }}"
                             loading="lazy"
                             class="w-full rounded-lg hover:opacity-90 transition-opacity">
                        @if($image->caption)
                            <p class="text-xs text-gray-500 mt-1 px-1">{{ $image->caption }}</p>
                        @endif
                    </div>
                @endforeach

                {{-- Lightbox Modal --}}
                <div x-show="isOpen" x-transition class="fixed inset-0 z-[9999] bg-black/90 flex items-center justify-center p-4"
                     @click.self="isOpen = false" @keydown.escape.window="isOpen = false">
                    <button @click="isOpen = false" class="absolute top-4 right-4 text-white text-2xl hover:text-gray-300">&times;</button>
                    <img :src="currentSrc" :alt="currentAlt" class="max-w-full max-h-[90vh] object-contain rounded-lg">
                </div>
            </div>

            <div class="mt-8">{{ $images->links() }}</div>
        @else
            <div class="text-center py-20">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <h3 class="font-display text-2xl text-brand-dark tracking-wider mb-2">NO PHOTOS YET</h3>
                <p class="text-gray-500">Gallery photos will appear here once uploaded via the admin panel.</p>
            </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
function lightbox() {
    return {
        isOpen: false,
        currentSrc: '',
        currentAlt: '',
        open(src, alt) {
            this.currentSrc = src;
            this.currentAlt = alt;
            this.isOpen = true;
        }
    }
}
</script>
@endpush

@endsection
