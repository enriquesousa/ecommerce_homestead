{{-- barra de navegación principal, para que quede pegada al top usamos sticky top-0 --}}
<header class="bg-gray-600 sticky top-0" x-data="dropdown()">

    <div class="container flex items-center h-16">

        <a :class="{'bg-opacity-100 text-orange-500' : open}" x-on:click="show()" class="flex flex-col items-center justify-center px-4 bg-white bg-opacity-25 text-white cursor-pointer font-semibold h-16">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>

            <span class="text-sm">
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

        <!-- Settings Avatar Dropdown -->
        <div class="mx-3 relative">
            
            @auth
                <x-jet-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        {{-- Mostrar foto de perfil --}}
                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </button>
                        
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-jet-dropdown-link>

                        <div class="border-t border-gray-100"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-jet-dropdown-link>
                        </form>
                    </x-slot>

                </x-jet-dropdown>
            @else 
                <x-jet-dropdown align="right" width="48">

                    {{-- icono que queremos mostrar --}}
                    <x-slot name="trigger">
                        <i class="fas fa-user-circle text-white text-3xl cursor-pointer"></i>
                    </x-slot>
                    
                    {{-- menu dropdown --}}
                    <x-slot name="content">
                        <x-jet-dropdown-link href="{{ route('login') }}">
                            {{ __('Login') }}
                        </x-jet-dropdown-link>

                        <x-jet-dropdown-link href="{{ route('register') }}">
                            {{ __('Register') }}
                        </x-jet-dropdown-link>
                    </x-slot>

                </x-jet-dropdown>
            @endauth

        </div>

        {{-- Cart Dropdown  --}}
        @livewire('dropdown-cart')        

    </div>

    {{-- menu --}}
    <nav id="navigation-menu" x-cloak x-show="open" class="bg-gray-700 bg-opacity-25 w-full absolute">
 
        <div class="container h-full">
            <div x-on:click.away="close()" class="grid grid-cols-4 h-full relative">

                {{-- Este ul ocupa una columna --}}
                <ul class="bg-white">
                    @foreach ($categories as $category)
                        <li class="navigation-link text-gray-500 hover:bg-orange-500 hover:text-white">

                            <a href="" class="py-2 px-4 text-sm flex items-center">
                                <span class="flex justify-center w-9">
                                    {!! $category->icon !!}
                                </span>
                                {{ $category->name }}
                            </a>

                            <div class="navigation-submenu bg-gray-100 absolute w-3/4 h-full top-0 right-0 hidden">

                                {{-- componente para el submenu --}}
                                <x-navigation-subcategories :category="$category" />
                                
                            </div>

                        </li>
                    @endforeach
                </ul>
                {{-- Este div ocupa 3 columnas --}}

                <div class="col-span-3 bg-gray-100">

                    {{-- con : antes de la variable le decimos que lo que queremos pasar es un objeto --}}
                    {{-- si no ponemos los : entonces estamos pasando solo la variable --}}
                    <x-navigation-subcategories :category="$categories->first()" />

                </div>

            </div>
        </div>

    </nav>

</header>

