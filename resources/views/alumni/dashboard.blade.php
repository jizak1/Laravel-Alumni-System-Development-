<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-secondary-900 mb-2">
                    <i class="fas fa-user-graduate mr-3 text-primary-600"></i>
                    Alumni Dashboard
                </h2>
                <p class="text-secondary-600">Welcome back, {{ auth()->user()->name }}! Manage your profile and contributions.</p>
            </div>
            <div class="flex items-center space-x-3">
                <div class="text-right">
                    <p class="text-sm text-secondary-500">Member since</p>
                    <p class="text-sm font-semibold text-secondary-700">{{ auth()->user()->created_at->format('M Y') }}</p>
                </div>
                @if(auth()->user()->profile && auth()->user()->profile->foto)
                    <img src="{{ asset('storage/' . auth()->user()->profile->foto) }}"
                         alt="Profile"
                         class="w-12 h-12 rounded-xl object-cover border-2 border-primary-200">
                @else
                    <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-lg">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Message -->
            <x-card class="mb-8 bg-gradient-to-r from-primary-500 to-primary-600 text-white border-0">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">
                            <i class="fas fa-star mr-2"></i>
                            Welcome back, {{ auth()->user()->name }}!
                        </h3>
                        <p class="text-primary-100 text-lg">Ready to make an impact? Manage your profile, thesis, and job opportunities here.</p>
                    </div>
                    <div class="hidden md:block">
                        <i class="fas fa-graduation-cap text-6xl text-white/20"></i>
                    </div>
                </div>

                @if(!$stats['profile_complete'])
                    <div class="mt-6 p-4 bg-white/10 backdrop-blur-sm rounded-xl border border-white/20">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold mb-1">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    Complete Your Profile
                                </p>
                                <p class="text-primary-100 text-sm">Add more details to help other alumni connect with you.</p>
                            </div>
                            <a href="{{ route('alumni.profile.edit') }}"
                               class="bg-white text-primary-600 px-4 py-2 rounded-lg font-semibold hover:bg-primary-50 transition-colors duration-200">
                                Complete Now
                            </a>
                        </div>
                    </div>
                @endif
            </x-card>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <x-stat-card
                    title="My Thesis"
                    :value="$stats['my_skripsi']"
                    icon="fas fa-book"
                    color="primary" />

                <x-stat-card
                    title="Job Posts"
                    :value="$stats['my_lowongan']"
                    icon="fas fa-briefcase"
                    color="success" />

                <div class="bg-white rounded-2xl shadow-soft border border-secondary-100 p-6 hover:shadow-medium transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-secondary-600 mb-1">Profile Status</p>
                            <div class="flex items-center">
                                <p class="text-lg font-bold {{ $stats['profile_complete'] ? 'text-success-600' : 'text-warning-600' }}">
                                    {{ $stats['profile_complete'] ? 'Complete' : 'Incomplete' }}
                                </p>
                                @if($stats['profile_complete'])
                                    <i class="fas fa-check-circle text-success-500 ml-2"></i>
                                @else
                                    <i class="fas fa-exclamation-triangle text-warning-500 ml-2"></i>
                                @endif
                            </div>
                            @if(!$stats['profile_complete'])
                                <a href="{{ route('alumni.profile.edit') }}"
                                   class="inline-flex items-center text-primary-600 hover:text-primary-700 text-sm font-medium mt-2 transition-colors duration-200">
                                    Complete now
                                    <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            @endif
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br {{ $stats['profile_complete'] ? 'from-success-500 to-success-600' : 'from-warning-500 to-warning-600' }} rounded-xl flex items-center justify-center shadow-medium">
                            <i class="fas fa-user text-white text-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent News -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Berita Terbaru</h3>
                        <div class="space-y-4">
                            @forelse($recent_berita as $berita)
                                <div class="border-l-4 border-blue-500 pl-4">
                                    <h4 class="font-medium text-gray-800">{{ $berita->judul }}</h4>
                                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit(strip_tags($berita->konten), 100) }}</p>
                                    <p class="text-xs text-gray-500 mt-2">{{ $berita->tanggal_posting->format('d M Y') }}</p>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center py-4">Belum ada berita terbaru</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Upcoming Events -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Event Mendatang</h3>
                        <div class="space-y-4">
                            @forelse($upcoming_events as $event)
                                <div class="border-l-4 border-green-500 pl-4">
                                    <h4 class="font-medium text-gray-800">{{ $event->judul }}</h4>
                                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($event->deskripsi, 100) }}</p>
                                    <div class="flex items-center text-xs text-gray-500 mt-2">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $event->tanggal->format('d M Y H:i') }}
                                        <svg class="w-4 h-4 ml-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ $event->lokasi }}
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center py-4">Belum ada event mendatang</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Recent Job Opportunities -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg lg:col-span-2">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Lowongan Kerja Terbaru</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @forelse($recent_lowongan as $lowongan)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <h4 class="font-medium text-gray-800">{{ $lowongan->judul }}</h4>
                                    <p class="text-sm text-gray-600 mt-1">{{ $lowongan->perusahaan }}</p>
                                    <p class="text-sm text-gray-500">{{ $lowongan->lokasi }}</p>
                                    <div class="flex items-center justify-between mt-3">
                                        <span class="text-xs text-gray-500">{{ $lowongan->tanggal_posting->format('d M Y') }}</span>
                                        @if($lowongan->link)
                                            <a href="{{ $lowongan->link }}" target="_blank" class="text-xs text-blue-600 hover:text-blue-800">
                                                Lihat Detail →
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-2">
                                    <p class="text-gray-500 text-center py-4">Belum ada lowongan kerja terbaru</p>
                                </div>
                            @endforelse
                        </div>
                        @if($recent_lowongan->count() > 0)
                            <div class="mt-4 text-center">
                                <a href="{{ route('alumni.lowongan.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Lihat semua lowongan →
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
