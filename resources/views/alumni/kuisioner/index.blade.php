<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kuisioner Alumni') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Kuisioner Tracer Study Alumni</h3>
                        <p class="text-gray-600">
                            Mohon bantuan Anda untuk mengisi kuisioner ini. Data yang Anda berikan akan membantu kami dalam meningkatkan kualitas pendidikan dan layanan kepada mahasiswa.
                        </p>
                        @if($sudah_mengisi)
                            <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                <p class="text-blue-800">
                                    <strong>Terima kasih!</strong> Anda sudah mengisi kuisioner ini. Anda dapat memperbarui jawaban Anda kapan saja.
                                </p>
                            </div>
                        @endif
                    </div>

                    @if($pertanyaan->count() > 0)
                        <form method="POST" action="{{ route('alumni.kuisioner.store') }}">
                            @csrf

                            <div class="space-y-6">
                                @foreach($pertanyaan as $p)
                                    <div class="border-b border-gray-200 pb-6">
                                        <label class="block text-sm font-medium text-gray-700 mb-3">
                                            {{ $p->teks }}
                                            @if($p->wajib)
                                                <span class="text-red-500">*</span>
                                            @endif
                                        </label>

                                        @if($p->tipe === 'text')
                                            <textarea 
                                                name="jawaban[{{ $p->id }}]" 
                                                rows="3" 
                                                class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                {{ $p->wajib ? 'required' : '' }}
                                            >{{ $jawaban[$p->id] ?? '' }}</textarea>

                                        @elseif($p->tipe === 'radio')
                                            <div class="space-y-2">
                                                @foreach($p->opsi as $opsi)
                                                    <label class="flex items-center">
                                                        <input 
                                                            type="radio" 
                                                            name="jawaban[{{ $p->id }}]" 
                                                            value="{{ $opsi }}"
                                                            class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                                            {{ ($jawaban[$p->id] ?? '') === $opsi ? 'checked' : '' }}
                                                            {{ $p->wajib ? 'required' : '' }}
                                                        >
                                                        <span class="ml-2 text-sm text-gray-700">{{ $opsi }}</span>
                                                    </label>
                                                @endforeach
                                            </div>

                                        @elseif($p->tipe === 'checkbox')
                                            <div class="space-y-2">
                                                @foreach($p->opsi as $opsi)
                                                    <label class="flex items-center">
                                                        <input 
                                                            type="checkbox" 
                                                            name="jawaban[{{ $p->id }}][]" 
                                                            value="{{ $opsi }}"
                                                            class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                                            {{ in_array($opsi, explode(', ', $jawaban[$p->id] ?? '')) ? 'checked' : '' }}
                                                        >
                                                        <span class="ml-2 text-sm text-gray-700">{{ $opsi }}</span>
                                                    </label>
                                                @endforeach
                                            </div>

                                        @elseif($p->tipe === 'select')
                                            <select 
                                                name="jawaban[{{ $p->id }}]" 
                                                class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                {{ $p->wajib ? 'required' : '' }}
                                            >
                                                <option value="">Pilih jawaban...</option>
                                                @foreach($p->opsi as $opsi)
                                                    <option 
                                                        value="{{ $opsi }}"
                                                        {{ ($jawaban[$p->id] ?? '') === $opsi ? 'selected' : '' }}
                                                    >
                                                        {{ $opsi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif

                                        @error("jawaban.{$p->id}")
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>

                            <div class="flex items-center justify-end mt-6">
                                <x-primary-button>
                                    {{ $sudah_mengisi ? 'Perbarui Jawaban' : 'Kirim Kuisioner' }}
                                </x-primary-button>
                            </div>
                        </form>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada kuisioner</h3>
                            <p class="mt-1 text-sm text-gray-500">Kuisioner belum tersedia saat ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
