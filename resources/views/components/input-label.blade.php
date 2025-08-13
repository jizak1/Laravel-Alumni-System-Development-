@props(['value', 'required' => false])

<label {{ $attributes->merge(['class' => 'block font-semibold text-sm text-secondary-700 mb-2']) }}>
    {{ $value ?? $slot }}
    @if($required)
        <span class="text-danger-500 ml-1">*</span>
    @endif
</label>
