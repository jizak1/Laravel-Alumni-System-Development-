<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Lowongan Kerja Saya') }}
            </h2>
            <a href="{{ route('alumni.lowongan.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Tambah Lowongan
            </a>
        </div>
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
                    @if($lowongan->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($lowongan as $item)
                                <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition duration-300">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $item->judul }}</h3>
                                    <p class="text-blue-600 font-medium mb-1">{{ $item->perusahaan }}</p>
                                    <p class="text-gray-600 mb-3">{{ $item->lokasi }}</p>
                                    <p class="text-sm text-gray-500 mb-4">{{ Str::limit($item->deskripsi, 100) }}</p>
                                    
                                    <div class="flex items-center justify-between mb-4">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            {{ $item->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            {{ $item->tanggal_posting->format('d M Y') }}
                                        </span>
                                    </div>

                                    @if($item->tanggal_berakhir)
                                        <p class="text-sm text-gray-600 mb-3">
                                            <strong>Berakhir:</strong> {{ $item->tanggal_berakhir->format('d M Y') }}
                                        </p>
                                    @endif

                                    <div class="flex items-center justify-between">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('alumni.lowongan.show', $item) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                Lihat
                                            </a>
                                            <a href="{{ route('alumni.lowongan.edit', $item) }}" class="text-yellow-600 hover:text-yellow-800 text-sm font-medium">
                                                Edit
                                            </a>
                                            <form action="{{ route('alumni.lowongan.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus lowongan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Hapus</button>
                                            </form>
                                        </div>
                                        
                                        @if($item->link)
                                            <a href="{{ $item->link }}" target="_blank" class="text-green-600 hover:text-green-800 text-sm font-medium">
                                                Link Apply →
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $lowongan->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m8 0H8m8 0v2a2 2 0 01-2 2H10a2 2 0 01-2-2V8m8 0V6a2 2 0 00-2-2H10a2 2 0 00-2 2v2" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada lowongan kerja</h3>
                            <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan lowongan kerja pertama.</p>
                            <div class="mt-6">
                                <a href="{{ route('alumni.lowongan.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    Tambah Lowongan
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
