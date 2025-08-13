@props(['disabled' => false, 'icon' => null])

<div class="relative">
    @if($icon)
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <i class="{{ $icon }} text-secondary-400"></i>
        </div>
    @endif

    <input {{ $disabled ? 'disabled' : '' }}
           {!! $attributes->merge([
               'class' => 'block w-full ' .
                         ($icon ? 'pl-12 ' : 'pl-4 ') .
                         'pr-4 py-3 border border-secondary-300 rounded-xl text-secondary-900 placeholder-secondary-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200 shadow-soft hover:shadow-medium disabled:bg-secondary-50 disabled:text-secondary-500 disabled:cursor-not-allowed'
           ]) !!}>
</div>
