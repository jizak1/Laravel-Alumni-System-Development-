<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Skripsi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('alumni.skripsi.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <!-- Judul -->
                                <div>
                                    <x-input-label for="judul" :value="__('Judul Skripsi')" />
                                    <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul')" required autofocus />
                                    <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                                </div>

                                <!-- Tahun -->
                                <div>
                                    <x-input-label for="tahun" :value="__('Tahun')" />
                                    <x-text-input id="tahun" class="block mt-1 w-full" type="number" name="tahun" :value="old('tahun', date('Y'))" min="1900" max="{{ date('Y') + 10 }}" required />
                                    <x-input-error :messages="$errors->get('tahun')" class="mt-2" />
                                </div>

                                <!-- Pembimbing 1 -->
                                <div>
                                    <x-input-label for="pembimbing1" :value="__('Pembimbing 1')" />
                                    <x-text-input id="pembimbing1" class="block mt-1 w-full" type="text" name="pembimbing1" :value="old('pembimbing1')" />
                                    <x-input-error :messages="$errors->get('pembimbing1')" class="mt-2" />
                                </div>

                                <!-- Pembimbing 2 -->
                                <div>
                                    <x-input-label for="pembimbing2" :value="__('Pembimbing 2')" />
                                    <x-text-input id="pembimbing2" class="block mt-1 w-full" type="text" name="pembimbing2" :value="old('pembimbing2')" />
                                    <x-input-error :messages="$errors->get('pembimbing2')" class="mt-2" />
                                </div>

                                <!-- Akses -->
                                <div>
                                    <x-input-label for="akses" :value="__('Akses')" />
                                    <select id="akses" name="akses" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="private" {{ old('akses') === 'private' ? 'selected' : '' }}>Private</option>
                                        <option value="public" {{ old('akses') === 'public' ? 'selected' : '' }}>Public</option>
                                    </select>
                                    <p class="text-sm text-gray-500 mt-1">Public: dapat diakses oleh semua orang. Private: hanya dapat diakses oleh Anda dan admin.</p>
                                    <x-input-error :messages="$errors->get('akses')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                <!-- Abstrak -->
                                <div>
                                    <x-input-label for="abstrak" :value="__('Abstrak')" />
                                    <textarea id="abstrak" name="abstrak" rows="8" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('abstrak') }}</textarea>
                                    <x-input-error :messages="$errors->get('abstrak')" class="mt-2" />
                                </div>

                                <!-- File PDF -->
                                <div>
                                    <x-input-label for="file" :value="__('File PDF Skripsi')" />
                                    <input id="file" type="file" name="file" accept=".pdf" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                    <p class="text-sm text-gray-500 mt-1">Format: PDF. Maksimal 10MB. (Opsional - dapat diupload nanti)</p>
                                    <x-input-error :messages="$errors->get('file')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 space-x-4">
                            <a href="{{ route('alumni.skripsi.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Batal
                            </a>
                            <x-primary-button>
                                {{ __('Simpan Skripsi') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
