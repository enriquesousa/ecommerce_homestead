<header class="bg-gray-600">
    <div class="container flex items-center h-16">

        <a class="flex flex-col items-center justify-center px-4 bg-white bg-opacity-25 text-white cursor-pointer font-semibold h-16">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>

            <span>
                Categorías
            </span>
        </a>

        <a href="/" class="ml-4">
            <x-jet-application-mark class="block h-9 w-auto" />
        </a>

        @livewire('search')

        {{-- si no le pasamos el valor de size, en resources/views/components/search.blade.php ya le dimos un valor por default --}}
        {{-- <x-search size="40" color="orange" /> --}}
        {{-- pasamos este componente a resources/views/livewire/search.blade.php --}}

    </div>
</header>

