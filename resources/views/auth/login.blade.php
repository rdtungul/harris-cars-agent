<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login — Harris Cars Service Center</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-body bg-brand-dark min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-brand-primary rounded-lg flex items-center justify-center mx-auto mb-4">
                <svg class="w-9 h-9 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99z"/>
                </svg>
            </div>
            <h1 class="font-display text-3xl text-white tracking-wider">HARRIS CARS</h1>
            <p class="text-gray-400 text-sm mt-1">Admin Panel</p>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-xl p-8 shadow-2xl">
            <h2 class="font-display text-2xl text-brand-dark tracking-wider mb-6 text-center">SIGN IN</h2>

            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-5 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                <div class="space-y-5">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                               class="w-full border rounded px-4 py-3 text-sm focus:ring-brand-primary focus:border-brand-primary transition-colors @error('email') border-red-500 @enderror">
                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" id="password" name="password" required
                               class="w-full border rounded px-4 py-3 text-sm focus:ring-brand-primary focus:border-brand-primary transition-colors @error('password') border-red-500 @enderror">
                        @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="rounded border-gray-300 text-brand-primary focus:ring-brand-primary">
                        <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                    </div>

                    <button type="submit"
                            class="w-full bg-brand-primary hover:bg-[#003370] text-white py-3 font-display text-xl tracking-wider transition-colors">
                        SIGN IN
                    </button>
                </div>
            </form>
        </div>

        <p class="text-center text-gray-500 text-xs mt-6">
            <a href="{{ route('home') }}" class="hover:text-gray-300 transition-colors">&larr; Back to Website</a>
        </p>
    </div>
</body>
</html>
