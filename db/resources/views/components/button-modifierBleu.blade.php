<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-white border border-transparent rounded-md font-semibold text-xs text-indigo-600 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-900 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
