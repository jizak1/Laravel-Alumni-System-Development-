@props(['active', 'icon' => null])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold text-primary-700 bg-primary-100 border border-primary-200 focus:outline-none focus:ring-2 focus:ring-primary-500 transition-all duration-200'
            : 'inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium text-secondary-600 hover:text-primary-600 hover:bg-primary-50 focus:outline-none focus:text-primary-600 focus:bg-primary-50 transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if($icon)
        <i class="{{ $icon }} mr-2"></i>
    @endif
    {{ $slot }}
</a>
