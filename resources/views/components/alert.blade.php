@props(['type' => 'info', 'dismissible' => true])

@php
$typeClasses = [
    'success' => 'bg-success-50 border-success-200 text-success-800',
    'error' => 'bg-danger-50 border-danger-200 text-danger-800',
    'warning' => 'bg-warning-50 border-warning-200 text-warning-800',
    'info' => 'bg-primary-50 border-primary-200 text-primary-800',
];

$iconClasses = [
    'success' => 'fas fa-check-circle text-success-500',
    'error' => 'fas fa-exclamation-circle text-danger-500',
    'warning' => 'fas fa-exclamation-triangle text-warning-500',
    'info' => 'fas fa-info-circle text-primary-500',
];

$alertClass = $typeClasses[$type] ?? $typeClasses['info'];
$iconClass = $iconClasses[$type] ?? $iconClasses['info'];
@endphp

<div {{ $attributes->merge(['class' => 'rounded-xl border p-4 ' . $alertClass]) }}
     @if($dismissible) x-data="{ show: true }" x-show="show" x-transition @endif>
    <div class="flex items-start">
        <div class="flex-shrink-0">
            <i class="{{ $iconClass }}"></i>
        </div>
        <div class="ml-3 flex-1">
            {{ $slot }}
        </div>
        @if($dismissible)
            <div class="ml-auto pl-3">
                <button @click="show = false" class="inline-flex rounded-md p-1.5 hover:bg-black/5 focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors duration-200">
                    <i class="fas fa-times text-sm opacity-60 hover:opacity-100"></i>
                </button>
            </div>
        @endif
    </div>
</div>
