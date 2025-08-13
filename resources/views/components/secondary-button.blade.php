<button {{ $attributes->merge(['type' => 'button', 'class' => 'group inline-flex items-center justify-center px-6 py-3 bg-white border border-secondary-300 rounded-xl font-semibold text-sm text-secondary-700 tracking-wide shadow-soft hover:bg-secondary-50 hover:border-secondary-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none']) }}>
    {{ $slot }}
</button>
