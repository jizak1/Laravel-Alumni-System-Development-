<nav x-data="{ open: false }" class="bg-white/95 backdrop-blur-md border-b border-secondary-200 shadow-soft sticky top-0 z-40">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                            <i class="fas fa-graduation-cap text-white text-lg"></i>
                        </div>
                        <div>
                            <h1 class="text-lg font-bold bg-gradient-to-r from-primary-600 to-primary-800 bg-clip-text text-transparent">
                                {{ config('app.name') }}
                            </h1>
                            <p class="text-xs text-secondary-500 font-medium">
                                {{ auth()->user()->isAdmin() ? 'Admin Panel' : 'Alumni Portal' }}
                            </p>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ml-10 sm:flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="fas fa-tachometer-alt">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if(auth()->user()->isAdmin())
                        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" icon="fas fa-users">
                            {{ __('Users') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.skripsi.index')" :active="request()->routeIs('admin.skripsi.*')" icon="fas fa-book">
                            {{ __('Thesis') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.berita.index')" :active="request()->routeIs('admin.berita.*')" icon="fas fa-newspaper">
                            {{ __('News') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.kuisioner.index')" :active="request()->routeIs('admin.kuisioner.*')" icon="fas fa-poll">
                            {{ __('Survey') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('alumni.profile.edit')" :active="request()->routeIs('alumni.profile.*')" icon="fas fa-user">
                            {{ __('Profile') }}
                        </x-nav-link>
                        <x-nav-link :href="route('alumni.skripsi.index')" :active="request()->routeIs('alumni.skripsi.*')" icon="fas fa-book">
                            {{ __('Thesis') }}
                        </x-nav-link>
                        <x-nav-link :href="route('alumni.lowongan.index')" :active="request()->routeIs('alumni.lowongan.*')" icon="fas fa-briefcase">
                            {{ __('Jobs') }}
                        </x-nav-link>
                        <x-nav-link :href="route('alumni.kuisioner.index')" :active="request()->routeIs('alumni.kuisioner.*')" icon="fas fa-poll">
                            {{ __('Survey') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 space-x-4">
                <!-- Notifications -->
                <button class="relative p-2 text-secondary-500 hover:text-primary-600 transition-colors duration-200">
                    <i class="fas fa-bell text-lg"></i>
                    <span class="absolute -top-1 -right-1 w-3 h-3 bg-danger-500 rounded-full"></span>
                </button>

                <!-- User Dropdown -->
                <x-dropdown align="right" width="64">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-3 px-4 py-2 border border-secondary-200 rounded-xl text-sm font-medium text-secondary-700 bg-white hover:bg-secondary-50 hover:border-secondary-300 focus:outline-none focus:ring-2 focus:ring-primary-500 transition-all duration-200">
                            <div class="w-8 h-8 bg-gradient-to-br from-primary-500 to-primary-600 rounded-lg flex items-center justify-center">
                                <span class="text-white text-sm font-semibold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </span>
                            </div>
                            <div class="text-left">
                                <div class="font-semibold">{{ Str::limit(Auth::user()->name, 15) }}</div>
                                <div class="text-xs text-secondary-500">{{ Auth::user()->isAdmin() ? 'Administrator' : 'Alumni' }}</div>
                            </div>
                            <i class="fas fa-chevron-down text-xs text-secondary-400"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-secondary-100">
                            <p class="text-sm font-medium text-secondary-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-secondary-500">{{ Auth::user()->email }}</p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center">
                            <i class="fas fa-user-edit mr-3 text-secondary-400"></i>
                            {{ __('Edit Profile') }}
                        </x-dropdown-link>

                        <x-dropdown-link href="#" class="flex items-center">
                            <i class="fas fa-cog mr-3 text-secondary-400"></i>
                            {{ __('Settings') }}
                        </x-dropdown-link>

                        <div class="border-t border-secondary-100 my-1"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="flex items-center text-danger-600 hover:bg-danger-50">
                                <i class="fas fa-sign-out-alt mr-3"></i>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
