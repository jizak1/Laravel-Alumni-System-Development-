@props(['hover' => true, 'padding' => 'p-6'])

<div {{ $attributes->merge([
    'class' => 'bg-white rounded-2xl shadow-soft border border-secondary-100 ' . 
               ($hover ? 'hover:shadow-medium hover:border-secondary-200 transition-all duration-300 transform hover:-translate-y-1' : '') . 
               ' ' . $padding
]) }}>
    {{ $slot }}
</div>
