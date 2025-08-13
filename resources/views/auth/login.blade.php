<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gradient-to-br from-primary-50 via-blue-50 to-indigo-100 min-h-screen">
    <!-- Background decoration -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary-200/30 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-blue-200/20 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-indigo-200/10 rounded-full blur-2xl"></div>
    </div>

    <div class="relative min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Header -->
            <div class="text-center">
                <div class="flex justify-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-primary-700 rounded-2xl flex items-center justify-center shadow-large">
                        <i class="fas fa-graduation-cap text-white text-2xl"></i>
                    </div>
                </div>
                <h2 class="text-3xl font-bold text-secondary-900 mb-2">Welcome Back!</h2>
                <p class="text-secondary-600">Sign in to your alumni account</p>
            </div>

            <!-- Login Form -->
            <x-card class="p-8">
                <!-- Session Status -->
                @if (session('status'))
                    <x-alert type="success" class="mb-6">
                        {{ session('status') }}
                    </x-alert>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" value="Email Address" required />
                        <x-text-input id="email"
                                      type="email"
                                      name="email"
                                      :value="old('email')"
                                      required
                                      autofocus
                                      autocomplete="username"
                                      icon="fas fa-envelope"
                                      placeholder="Enter your email address" />
                        <x-input-error :messages="$errors->get('email')" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" value="Password" required />
                        <x-text-input id="password"
                                      type="password"
                                      name="password"
                                      required
                                      autocomplete="current-password"
                                      icon="fas fa-lock"
                                      placeholder="Enter your password" />
                        <x-input-error :messages="$errors->get('password')" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me"
                                   type="checkbox"
                                   class="rounded border-secondary-300 text-primary-600 shadow-sm focus:ring-primary-500"
                                   name="remember">
                            <span class="ml-2 text-sm text-secondary-600">Remember me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-primary-600 hover:text-primary-700 font-medium transition-colors duration-200"
                               href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <x-primary-button class="w-full justify-center">
                            Sign In
                        </x-primary-button>
                    </div>
                </form>

                <!-- Divider -->
                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-secondary-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-secondary-500">Don't have an account?</span>
                        </div>
                    </div>
                </div>

                <!-- Register Link -->
                <div class="mt-6">
                    <a href="{{ route('register') }}"
                       class="w-full flex justify-center items-center px-6 py-3 border border-secondary-300 rounded-xl text-sm font-semibold text-secondary-700 bg-white hover:bg-secondary-50 hover:border-secondary-400 focus:outline-none focus:ring-2 focus:ring-primary-500 transition-all duration-200">
                        <i class="fas fa-user-plus mr-2"></i>
                        Create Alumni Account
                    </a>
                </div>
            </x-card>

            <!-- Back to Home -->
            <div class="text-center">
                <a href="{{ route('landing') }}"
                   class="inline-flex items-center text-secondary-600 hover:text-primary-600 text-sm font-medium transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</body>
</html>
