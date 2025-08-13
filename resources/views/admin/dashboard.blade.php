<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-secondary-900 mb-2">
                    <i class="fas fa-tachometer-alt mr-3 text-primary-600"></i>
                    Admin Dashboard
                </h2>
                <p class="text-secondary-600">Welcome back! Here's what's happening with your platform.</p>
            </div>
            <div class="flex items-center space-x-3">
                <div class="text-right">
                    <p class="text-sm text-secondary-500">Last updated</p>
                    <p class="text-sm font-semibold text-secondary-700">{{ now()->format('M d, Y H:i') }}</p>
                </div>
                <button class="bg-primary-500 hover:bg-primary-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200 transform hover:scale-105">
                    <i class="fas fa-sync-alt mr-2"></i>
                    Refresh
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <x-stat-card
                    title="Total Alumni"
                    :value="$stats['total_alumni']"
                    icon="fas fa-users"
                    color="primary"
                    :trend="5.2" />

                <x-stat-card
                    title="Total Thesis"
                    :value="$stats['total_skripsi']"
                    icon="fas fa-book"
                    color="success"
                    :trend="12.5" />

                <x-stat-card
                    title="Pending Approval"
                    :value="$stats['pending_skripsi']"
                    icon="fas fa-clock"
                    color="warning" />

                <x-stat-card
                    title="Job Opportunities"
                    :value="$stats['total_lowongan']"
                    icon="fas fa-briefcase"
                    color="secondary"
                    :trend="8.3" />

                <x-stat-card
                    title="News Articles"
                    :value="$stats['total_berita']"
                    icon="fas fa-newspaper"
                    color="primary"
                    :trend="3.1" />

                <x-stat-card
                    title="Events"
                    :value="$stats['total_event']"
                    icon="fas fa-calendar"
                    color="success"
                    :trend="15.7" />
            </div>

            <!-- Recent Data -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Pending Skripsi -->
                <x-card class="animate-slide-up">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-secondary-900 flex items-center">
                            <i class="fas fa-clock mr-3 text-warning-500"></i>
                            Pending Approvals
                        </h3>
                        <span class="bg-warning-100 text-warning-700 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ $recent_skripsi->count() }} items
                        </span>
                    </div>

                    <div class="space-y-4">
                        @forelse($recent_skripsi as $skripsi)
                            <div class="flex items-center justify-between p-4 bg-gradient-to-r from-secondary-50 to-primary-50 rounded-xl border border-secondary-100 hover:shadow-soft transition-all duration-200">
                                <div class="flex-1">
                                    <p class="font-semibold text-secondary-900 mb-1">{{ Str::limit($skripsi->judul, 40) }}</p>
                                    <p class="text-sm text-secondary-600 flex items-center">
                                        <i class="fas fa-user mr-2"></i>
                                        {{ $skripsi->user->name }}
                                    </p>
                                    <p class="text-xs text-secondary-500 mt-1">
                                        <i class="fas fa-calendar mr-1"></i>
                                        {{ $skripsi->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="px-3 py-1 text-xs font-semibold text-warning-700 bg-warning-200 rounded-full">
                                        <i class="fas fa-hourglass-half mr-1"></i>
                                        Pending
                                    </span>
                                    <a href="{{ route('admin.skripsi.show', $skripsi) }}"
                                       class="text-primary-600 hover:text-primary-700 p-2 rounded-lg hover:bg-primary-50 transition-colors duration-200">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <i class="fas fa-check-circle text-4xl text-success-400 mb-3"></i>
                                <p class="text-secondary-500 font-medium">All caught up!</p>
                                <p class="text-sm text-secondary-400">No pending approvals at the moment.</p>
                            </div>
                        @endforelse
                    </div>

                    @if($recent_skripsi->count() > 0)
                        <div class="mt-6 pt-4 border-t border-secondary-100">
                            <a href="{{ route('admin.skripsi.index') }}"
                               class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold text-sm transition-colors duration-200">
                                View all pending approvals
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    @endif
                </x-card>

                <!-- Recent Alumni -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Alumni Terbaru</h3>
                        <div class="space-y-3">
                            @forelse($recent_alumni as $alumni)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $alumni->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $alumni->email }}</p>
                                    </div>
                                    <span class="text-xs text-gray-500">
                                        {{ $alumni->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center py-4">Belum ada alumni yang terdaftar</p>
                            @endforelse
                        </div>
                        @if($recent_alumni->count() > 0)
                            <div class="mt-4">
                                <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Lihat semua →
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
