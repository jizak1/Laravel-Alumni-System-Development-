@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'mt-2']) }}>
        @foreach ((array) $messages as $message)
            <div class="flex items-center text-sm text-danger-600 bg-danger-50 border border-danger-200 rounded-lg px-3 py-2 mb-1">
                <i class="fas fa-exclamation-circle mr-2 text-danger-500"></i>
                {{ $message }}
            </div>
        @endforeach
    </div>
@endif
