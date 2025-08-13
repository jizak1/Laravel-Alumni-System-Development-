<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('alumni.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <!-- Name -->
                                <div>
                                    <x-input-label for="name" :value="__('Nama Lengkap')" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <!-- Email -->
                                <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- NIM -->
                                <div>
                                    <x-input-label for="nim" :value="__('NIM')" />
                                    <x-text-input id="nim" class="block mt-1 w-full" type="text" name="nim" :value="old('nim', $profile->nim ?? '')" />
                                    <x-input-error :messages="$errors->get('nim')" class="mt-2" />
                                </div>

                                <!-- Tahun Lulus -->
                                <div>
                                    <x-input-label for="tahun_lulus" :value="__('Tahun Lulus')" />
                                    <x-text-input id="tahun_lulus" class="block mt-1 w-full" type="number" name="tahun_lulus" :value="old('tahun_lulus', $profile->tahun_lulus ?? '')" min="1900" max="{{ date('Y') + 10 }}" />
                                    <x-input-error :messages="$errors->get('tahun_lulus')" class="mt-2" />
                                </div>

                                <!-- Telepon -->
                                <div>
                                    <x-input-label for="telepon" :value="__('Nomor Telepon')" />
                                    <x-text-input id="telepon" class="block mt-1 w-full" type="text" name="telepon" :value="old('telepon', $profile->telepon ?? '')" />
                                    <x-input-error :messages="$errors->get('telepon')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                <!-- Alamat -->
                                <div>
                                    <x-input-label for="alamat" :value="__('Alamat')" />
                                    <textarea id="alamat" name="alamat" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('alamat', $profile->alamat ?? '') }}</textarea>
                                    <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                                </div>

                                <!-- Pekerjaan -->
                                <div>
                                    <x-input-label for="pekerjaan" :value="__('Pekerjaan Saat Ini')" />
                                    <x-text-input id="pekerjaan" class="block mt-1 w-full" type="text" name="pekerjaan" :value="old('pekerjaan', $profile->pekerjaan ?? '')" />
                                    <x-input-error :messages="$errors->get('pekerjaan')" class="mt-2" />
                                </div>

                                <!-- Foto Profil -->
                                <div>
                                    <x-input-label for="foto" :value="__('Foto Profil')" />
                                    
                                    @if($profile && $profile->foto)
                                        <div class="mt-2 mb-4">
                                            <img src="{{ asset('storage/' . $profile->foto) }}" alt="Foto Profil" class="w-32 h-32 object-cover rounded-lg">
                                            <p class="text-sm text-gray-500 mt-1">Foto saat ini</p>
                                        </div>
                                    @endif
                                    
                                    <input id="foto" type="file" name="foto" accept="image/*" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                    <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB.</p>
                                    <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button class="ml-4">
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
