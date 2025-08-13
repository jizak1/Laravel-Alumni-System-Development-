<button {{ $attributes->merge(['type' => 'submit', 'class' => 'group inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 border border-transparent rounded-xl font-semibold text-sm text-white tracking-wide focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105 shadow-medium hover:shadow-large disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none']) }}>
    {{ $slot }}
    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
</button>
