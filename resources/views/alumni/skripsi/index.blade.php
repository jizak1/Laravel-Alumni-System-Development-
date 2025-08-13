<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Skripsi Saya') }}
            </h2>
            <a href="{{ route('alumni.skripsi.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Tambah Skripsi
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

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($skripsi->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($skripsi as $item)
                                <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition duration-300">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $item->judul }}</h3>
                                    <p class="text-gray-600 mb-3">Tahun {{ $item->tahun }}</p>
                                    <p class="text-sm text-gray-500 mb-4">{{ Str::limit($item->abstrak, 120) }}</p>
                                    
                                    <div class="flex items-center justify-between mb-4">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            {{ $item->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                               ($item->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            {{ $item->akses === 'public' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ ucfirst($item->akses) }}
                                        </span>
                                    </div>

                                    @if($item->pembimbing1)
                                        <p class="text-sm text-gray-600 mb-1">
                                            <strong>Pembimbing 1:</strong> {{ $item->pembimbing1 }}
                                        </p>
                                    @endif

                                    @if($item->pembimbing2)
                                        <p class="text-sm text-gray-600 mb-3">
                                            <strong>Pembimbing 2:</strong> {{ $item->pembimbing2 }}
                                        </p>
                                    @endif

                                    <div class="flex items-center justify-between">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('alumni.skripsi.show', $item) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                Lihat
                                            </a>
                                            @if(in_array($item->status, ['pending', 'rejected']))
                                                <a href="{{ route('alumni.skripsi.edit', $item) }}" class="text-yellow-600 hover:text-yellow-800 text-sm font-medium">
                                                    Edit
                                                </a>
                                            @endif
                                            <form action="{{ route('alumni.skripsi.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus skripsi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Hapus</button>
                                            </form>
                                        </div>
                                        
                                        @if($item->file)
                                            <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="text-green-600 hover:text-green-800 text-sm font-medium">
                                                Download PDF
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $skripsi->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada skripsi</h3>
                            <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan skripsi pertama Anda.</p>
                            <div class="mt-6">
                                <a href="{{ route('alumni.skripsi.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    Tambah Skripsi
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
