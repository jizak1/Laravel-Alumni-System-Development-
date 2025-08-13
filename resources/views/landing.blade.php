<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gradient-to-br from-slate-50 to-blue-50"
      x-data="{
          scrolled: false,
          mobileMenuOpen: false
      }"
      @scroll.window="scrolled = window.pageYOffset > 50">
    <!-- Navigation -->
    <nav class="fixed w-full z-50 transition-all duration-300"
         :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-soft' : 'bg-transparent'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-white text-lg"></i>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold bg-gradient-to-r from-primary-600 to-primary-800 bg-clip-text text-transparent">
                                {{ config('app.name') }}
                            </h1>
                            <p class="text-xs text-secondary-500 font-medium">Alumni & Thesis Portal</p>
                        </div>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="#about" class="text-secondary-600 hover:text-primary-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                        <i class="fas fa-info-circle mr-2"></i>About
                    </a>
                    <a href="#news" class="text-secondary-600 hover:text-primary-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                        <i class="fas fa-newspaper mr-2"></i>News
                    </a>
                    <a href="#events" class="text-secondary-600 hover:text-primary-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                        <i class="fas fa-calendar mr-2"></i>Events
                    </a>
                    <a href="#jobs" class="text-secondary-600 hover:text-primary-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                        <i class="fas fa-briefcase mr-2"></i>Jobs
                    </a>

                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-primary-500 hover:bg-primary-600 text-white px-6 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 transform hover:scale-105 shadow-medium">
                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-secondary-600 hover:text-primary-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white px-6 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 transform hover:scale-105 shadow-medium">
                            <i class="fas fa-user-plus mr-2"></i>Join Alumni
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                            class="text-secondary-600 hover:text-primary-600 p-2 rounded-lg transition-colors duration-200">
                        <i class="fas fa-bars text-xl" x-show="!mobileMenuOpen"></i>
                        <i class="fas fa-times text-xl" x-show="mobileMenuOpen"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-95"
             class="md:hidden bg-white/95 backdrop-blur-md border-t border-secondary-200">
            <div class="px-4 py-6 space-y-3">
                <a href="#about" class="block text-secondary-600 hover:text-primary-600 px-4 py-3 rounded-lg text-sm font-medium transition-colors duration-200">
                    <i class="fas fa-info-circle mr-3"></i>About
                </a>
                <a href="#news" class="block text-secondary-600 hover:text-primary-600 px-4 py-3 rounded-lg text-sm font-medium transition-colors duration-200">
                    <i class="fas fa-newspaper mr-3"></i>News
                </a>
                <a href="#events" class="block text-secondary-600 hover:text-primary-600 px-4 py-3 rounded-lg text-sm font-medium transition-colors duration-200">
                    <i class="fas fa-calendar mr-3"></i>Events
                </a>
                <a href="#jobs" class="block text-secondary-600 hover:text-primary-600 px-4 py-3 rounded-lg text-sm font-medium transition-colors duration-200">
                    <i class="fas fa-briefcase mr-3"></i>Jobs
                </a>

                @auth
                    <a href="{{ route('dashboard') }}" class="block bg-primary-500 hover:bg-primary-600 text-white px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 text-center">
                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="block text-secondary-600 hover:text-primary-600 px-4 py-3 rounded-lg text-sm font-medium transition-colors duration-200">
                        <i class="fas fa-sign-in-alt mr-3"></i>Login
                    </a>
                    <a href="{{ route('register') }}" class="block bg-gradient-to-r from-primary-500 to-primary-600 text-white px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 text-center">
                        <i class="fas fa-user-plus mr-2"></i>Join Alumni
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background with animated gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-primary-700 to-primary-900"></div>
        <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-primary-500/20 to-transparent"></div>

        <!-- Animated background elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-white/10 rounded-full blur-3xl animate-bounce-subtle"></div>
            <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-white/5 rounded-full blur-3xl animate-bounce-subtle" style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-white/5 rounded-full blur-2xl animate-pulse"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 text-center">
            <div class="animate-fade-in">
                <!-- Badge -->
                <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white/90 text-sm font-medium mb-8 border border-white/20">
                    <i class="fas fa-star mr-2 text-yellow-300"></i>
                    Trusted by 1000+ Alumni
                </div>

                <!-- Main heading -->
                <h1 class="text-5xl md:text-7xl font-bold mb-8 leading-tight">
                    <span class="bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">
                        Alumni & Thesis
                    </span>
                    <br>
                    <span class="text-white">
                        Information System
                    </span>
                </h1>

                <!-- Subtitle -->
                <p class="text-xl md:text-2xl mb-12 text-blue-100 max-w-4xl mx-auto leading-relaxed">
                    Connect with fellow alumni, share academic achievements, and discover career opportunities in our comprehensive digital platform
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
                    @guest
                        <a href="{{ route('register') }}"
                           class="group bg-white text-primary-600 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-blue-50 transition-all duration-300 transform hover:scale-105 shadow-large flex items-center">
                            <i class="fas fa-rocket mr-3 group-hover:animate-bounce-subtle"></i>
                            Join Our Community
                            <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform duration-300"></i>
                        </a>
                    @endguest
                    <a href="#about"
                       class="group border-2 border-white/30 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-white/10 backdrop-blur-sm transition-all duration-300 transform hover:scale-105 flex items-center">
                        <i class="fas fa-play mr-3"></i>
                        Explore Features
                        <i class="fas fa-chevron-down ml-3 group-hover:translate-y-1 transition-transform duration-300"></i>
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto">
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white mb-2">1000+</div>
                        <div class="text-blue-200 text-sm font-medium">Alumni Connected</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white mb-2">500+</div>
                        <div class="text-blue-200 text-sm font-medium">Thesis Published</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white mb-2">200+</div>
                        <div class="text-blue-200 text-sm font-medium">Job Opportunities</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white mb-2">50+</div>
                        <div class="text-blue-200 text-sm font-medium">Events Hosted</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <a href="#about" class="text-white/70 hover:text-white transition-colors duration-300">
                <i class="fas fa-chevron-down text-2xl"></i>
            </a>
        </div>
    </section>

    <!-- About Section -->
    @if($profil_prodi)
    <section id="about" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ $profil_prodi->nama_prodi }}</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $profil_prodi->deskripsi }}</p>
            </div>
            
            @if($profil_prodi->visi || $profil_prodi->misi)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @if($profil_prodi->visi)
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Visi</h3>
                    <p class="text-gray-600">{{ $profil_prodi->visi }}</p>
                </div>
                @endif
                
                @if($profil_prodi->misi)
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Misi</h3>
                    <p class="text-gray-600">{{ $profil_prodi->misi }}</p>
                </div>
                @endif
            </div>
            @endif
        </div>
    </section>
    @endif

    <!-- News Section -->
    @if($recent_berita->count() > 0)
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Berita Terbaru</h2>
                <p class="text-lg text-gray-600">Informasi terkini seputar program studi dan alumni</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($recent_berita as $berita)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                    @endif
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $berita->judul }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit(strip_tags($berita->konten), 120) }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">{{ $berita->tanggal_posting->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Events Section -->
    @if($upcoming_events->count() > 0)
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Event Mendatang</h2>
                <p class="text-lg text-gray-600">Jangan lewatkan acara-acara menarik untuk alumni</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($upcoming_events as $event)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if($event->gambar)
                        <img src="{{ asset('storage/' . $event->gambar) }}" alt="{{ $event->judul }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $event->judul }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($event->deskripsi, 120) }}</p>
                        <div class="space-y-2">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $event->tanggal->format('d M Y H:i') }}
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $event->lokasi }}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Job Opportunities Section -->
    @if($recent_lowongan->count() > 0)
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Lowongan Kerja</h2>
                <p class="text-lg text-gray-600">Peluang karir terbaru untuk alumni</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($recent_lowongan as $lowongan)
                <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition duration-300">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $lowongan->judul }}</h3>
                    <p class="text-blue-600 font-medium mb-1">{{ $lowongan->perusahaan }}</p>
                    <p class="text-gray-600 mb-3">{{ $lowongan->lokasi }}</p>
                    <p class="text-sm text-gray-500 mb-4">{{ Str::limit($lowongan->deskripsi, 100) }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500">{{ $lowongan->tanggal_posting->format('d M Y') }}</span>
                        @if($lowongan->link)
                            <a href="{{ $lowongan->link }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Lihat Detail →
                            </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Thesis Section -->
    @if($public_skripsi->count() > 0)
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Skripsi Publik</h2>
                <p class="text-lg text-gray-600">Karya ilmiah alumni yang dapat diakses publik</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($public_skripsi as $skripsi)
                <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition duration-300">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $skripsi->judul }}</h3>
                    <p class="text-blue-600 font-medium mb-1">{{ $skripsi->user->name }}</p>
                    <p class="text-gray-600 mb-3">Tahun {{ $skripsi->tahun }}</p>
                    <p class="text-sm text-gray-500 mb-4">{{ Str::limit($skripsi->abstrak, 120) }}</p>
                    <div class="flex items-center justify-between">
                        <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full">
                            {{ ucfirst($skripsi->status) }}
                        </span>
                        @if($skripsi->file)
                            <a href="{{ asset('storage/' . $skripsi->file) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Download PDF →
                            </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ config('app.name') }}</h3>
                    <p class="text-gray-300">Platform untuk menghubungkan alumni, berbagi karya ilmiah, dan mencari peluang karir.</p>
                </div>
                
                @if($profil_prodi)
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <div class="space-y-2 text-gray-300">
                        @if($profil_prodi->kontak)
                            <p>{{ $profil_prodi->kontak }}</p>
                        @endif
                        @if($profil_prodi->email)
                            <p>{{ $profil_prodi->email }}</p>
                        @endif
                        @if($profil_prodi->website)
                            <p><a href="{{ $profil_prodi->website }}" class="hover:text-white">{{ $profil_prodi->website }}</a></p>
                        @endif
                    </div>
                </div>
                @endif
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <div class="space-y-2">
                        @guest
                            <a href="{{ route('login') }}" class="block text-gray-300 hover:text-white">Login</a>
                            <a href="{{ route('register') }}" class="block text-gray-300 hover:text-white">Daftar Alumni</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="block text-gray-300 hover:text-white">Dashboard</a>
                        @endguest
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-300">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
