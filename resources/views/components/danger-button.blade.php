<button {{ $attributes->merge(['type' => 'submit', 'class' => 'group inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-danger-500 to-danger-600 hover:from-danger-600 hover:to-danger-700 border border-transparent rounded-xl font-semibold text-sm text-white tracking-wide focus:outline-none focus:ring-2 focus:ring-danger-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105 shadow-medium hover:shadow-large disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none']) }}>
    <i class="fas fa-exclamation-triangle mr-2"></i>
    {{ $slot }}
</button>
