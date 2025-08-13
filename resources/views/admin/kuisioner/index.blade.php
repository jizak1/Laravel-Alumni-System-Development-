<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Hasil Kuisioner Alumni') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.kuisioner.questions') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Kelola Pertanyaan
                </a>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Export Data
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                        <a href="{{ route('admin.kuisioner.export', ['format' => 'excel']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Export Excel
                        </a>
                        <a href="{{ route('admin.kuisioner.export', ['format' => 'pdf']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Export PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-700">Total Alumni</h3>
                                <p class="text-3xl font-bold text-blue-600">{{ $total_alumni }}</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-700">Total Responden</h3>
                                <p class="text-3xl font-bold text-green-600">{{ $total_responden }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ $total_alumni > 0 ? round(($total_responden / $total_alumni) * 100, 1) : 0 }}% response rate
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Questions and Responses -->
            @if($pertanyaan->count() > 0)
                <div class="space-y-6">
                    @foreach($pertanyaan as $p)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                    {{ $p->teks }}
                                    @if($p->wajib)
                                        <span class="text-red-500 text-sm">(Wajib)</span>
                                    @endif
                                </h3>

                                @if(in_array($p->tipe, ['radio', 'select', 'checkbox']))
                                    <!-- Show statistics for multiple choice questions -->
                                    @php
                                        $responseCount = $responses[$p->id]->count();
                                        $answerCounts = [];
                                        foreach($responses[$p->id] as $response) {
                                            $answers = explode(', ', $response->jawaban);
                                            foreach($answers as $answer) {
                                                $answer = trim($answer);
                                                if (!empty($answer)) {
                                                    $answerCounts[$answer] = ($answerCounts[$answer] ?? 0) + 1;
                                                }
                                            }
                                        }
                                    @endphp

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <h4 class="font-medium text-gray-700 mb-2">Statistik Jawaban:</h4>
                                            @foreach($answerCounts as $answer => $count)
                                                <div class="flex items-center justify-between mb-2">
                                                    <span class="text-sm text-gray-600">{{ $answer }}</span>
                                                    <div class="flex items-center">
                                                        <div class="w-32 bg-gray-200 rounded-full h-2 mr-2">
                                                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $responseCount > 0 ? ($count / $responseCount) * 100 : 0 }}%"></div>
                                                        </div>
                                                        <span class="text-sm font-medium text-gray-700">{{ $count }} ({{ $responseCount > 0 ? round(($count / $responseCount) * 100, 1) : 0 }}%)</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <!-- Show recent responses for text questions -->
                                    <div>
                                        <h4 class="font-medium text-gray-700 mb-2">Jawaban Terbaru:</h4>
                                        <div class="space-y-2 max-h-40 overflow-y-auto">
                                            @foreach($responses[$p->id]->take(5) as $response)
                                                <div class="p-3 bg-gray-50 rounded-lg">
                                                    <p class="text-sm text-gray-800">{{ $response->jawaban }}</p>
                                                    <p class="text-xs text-gray-500 mt-1">- {{ $response->user->name }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                        @if($responses[$p->id]->count() > 5)
                                            <p class="text-sm text-gray-500 mt-2">
                                                Dan {{ $responses[$p->id]->count() - 5 }} jawaban lainnya...
                                            </p>
                                        @endif
                                    </div>
                                @endif

                                <div class="mt-4 text-sm text-gray-500">
                                    Total responden: {{ $responses[$p->id]->count() }} dari {{ $total_alumni }} alumni
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada pertanyaan kuisioner</h3>
                        <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan pertanyaan kuisioner.</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.kuisioner.questions.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                Tambah Pertanyaan
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
