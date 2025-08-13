@props(['title', 'value', 'icon', 'color' => 'primary', 'trend' => null])

@php
$colorClasses = [
    'primary' => 'from-primary-500 to-primary-600 text-primary-600',
    'success' => 'from-success-500 to-success-600 text-success-600',
    'warning' => 'from-warning-500 to-warning-600 text-warning-600',
    'danger' => 'from-danger-500 to-danger-600 text-danger-600',
    'secondary' => 'from-secondary-500 to-secondary-600 text-secondary-600',
];

$gradientClass = $colorClasses[$color] ?? $colorClasses['primary'];
$iconColorClass = explode(' ', $gradientClass)[2];
@endphp

<div class="bg-white rounded-2xl shadow-soft border border-secondary-100 p-6 hover:shadow-medium transition-all duration-300 transform hover:-translate-y-1">
    <div class="flex items-center justify-between">
        <div class="flex-1">
            <p class="text-sm font-medium text-secondary-600 mb-1">{{ $title }}</p>
            <div class="flex items-baseline">
                <p class="text-3xl font-bold text-secondary-900">{{ $value }}</p>
                @if($trend)
                    <span class="ml-2 text-sm font-medium {{ $trend > 0 ? 'text-success-600' : 'text-danger-600' }}">
                        <i class="fas fa-{{ $trend > 0 ? 'arrow-up' : 'arrow-down' }} mr-1"></i>
                        {{ abs($trend) }}%
                    </span>
                @endif
            </div>
        </div>
        <div class="w-12 h-12 bg-gradient-to-br {{ $gradientClass }} rounded-xl flex items-center justify-center shadow-medium">
            <i class="{{ $icon }} text-white text-lg"></i>
        </div>
    </div>
</div>
