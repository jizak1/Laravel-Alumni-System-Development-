<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Lowongan Kerja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('alumni.lowongan.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <!-- Judul -->
                                <div>
                                    <x-input-label for="judul" :value="__('Judul Lowongan')" />
                                    <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul')" required autofocus />
                                    <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                                </div>

                                <!-- Perusahaan -->
                                <div>
                                    <x-input-label for="perusahaan" :value="__('Nama Perusahaan')" />
                                    <x-text-input id="perusahaan" class="block mt-1 w-full" type="text" name="perusahaan" :value="old('perusahaan')" required />
                                    <x-input-error :messages="$errors->get('perusahaan')" class="mt-2" />
                                </div>

                                <!-- Lokasi -->
                                <div>
                                    <x-input-label for="lokasi" :value="__('Lokasi')" />
                                    <x-text-input id="lokasi" class="block mt-1 w-full" type="text" name="lokasi" :value="old('lokasi')" required />
                                    <x-input-error :messages="$errors->get('lokasi')" class="mt-2" />
                                </div>

                                <!-- Link Apply -->
                                <div>
                                    <x-input-label for="link" :value="__('Link Apply (Opsional)')" />
                                    <x-text-input id="link" class="block mt-1 w-full" type="url" name="link" :value="old('link')" />
                                    <p class="text-sm text-gray-500 mt-1">URL lengkap untuk melamar pekerjaan</p>
                                    <x-input-error :messages="$errors->get('link')" class="mt-2" />
                                </div>

                                <!-- Tanggal Posting -->
                                <div>
                                    <x-input-label for="tanggal_posting" :value="__('Tanggal Posting')" />
                                    <x-text-input id="tanggal_posting" class="block mt-1 w-full" type="date" name="tanggal_posting" :value="old('tanggal_posting', date('Y-m-d'))" required />
                                    <x-input-error :messages="$errors->get('tanggal_posting')" class="mt-2" />
                                </div>

                                <!-- Tanggal Berakhir -->
                                <div>
                                    <x-input-label for="tanggal_berakhir" :value="__('Tanggal Berakhir (Opsional)')" />
                                    <x-text-input id="tanggal_berakhir" class="block mt-1 w-full" type="date" name="tanggal_berakhir" :value="old('tanggal_berakhir')" />
                                    <p class="text-sm text-gray-500 mt-1">Kosongkan jika tidak ada batas waktu</p>
                                    <x-input-error :messages="$errors->get('tanggal_berakhir')" class="mt-2" />
                                </div>

                                <!-- Status -->
                                <div>
                                    <x-input-label for="status" :value="__('Status')" />
                                    <select id="status" name="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                <!-- Deskripsi -->
                                <div>
                                    <x-input-label for="deskripsi" :value="__('Deskripsi Lowongan')" />
                                    <textarea id="deskripsi" name="deskripsi" rows="15" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('deskripsi') }}</textarea>
                                    <p class="text-sm text-gray-500 mt-1">Jelaskan detail pekerjaan, kualifikasi, dan benefit yang ditawarkan</p>
                                    <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 space-x-4">
                            <a href="{{ route('alumni.lowongan.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Batal
                            </a>
                            <x-primary-button>
                                {{ __('Simpan Lowongan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
