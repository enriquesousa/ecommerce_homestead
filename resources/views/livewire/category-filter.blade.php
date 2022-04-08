<div>
    
    {{-- Tarjeta de Cabecera donde va estar el titulo de la categoría y los dos iconos para poder escoger si queremos ver las Subcategorías en grid o el lista --}}
    {{-- El 'flex justify-between' lo usamos para poder colocar el titulo a la izquierda y los iconos a la derecha --}}
    <div class="bg-white rounded-lg shadow-lg mb-6">
        <div class="px-6 py-2 flex justify-between items-center">
            <h1 class="font-semibold text-gray-700 uppercase">{{ $category->name }}</h1>

            <div class="grid grid-cols-2 border border-gray-200 divide-x divide-gray-200 text-gray-500">
                <i class="fas fa-border-all p-3 cursor-pointer"></i>
                <i class="fas fa-th-list p-3 cursor-pointer"></i>
            </div>

        </div>
    </div>

    <div class="grid grid-cols-5 gap-6">

        {{-- Donde va estar el menu de las Subcategorías y menu de las Marcas --}}
        <aside>
            
            {{-- menu Subcategorías --}}
            <h2 class="font-semibold text-center mb-2">Subcategorías</h2>
            <ul class="divide-y divide-gray-200">
                @foreach ($category->subcategories as $subcategory)
                    <li class="py-2 text-sm">
                        <a class="cursor-pointer hover:text-orange-500 capitalize {{ $subcategoria == $subcategory->name ? 'text-orange-500 font-semibold' : '' }}" wire:click="$set('subcategoria', '{{ $subcategory->name }}')">{{ $subcategory->name }}</a>
                    </li>
                @endforeach
            </ul>

            {{-- menu Marcas --}}
            <h2 class="font-semibold text-center mt-4 mb-2">Marcas</h2>
            <ul class="divide-y divide-gray-200">
                @foreach ($category->brands as $brand)
                    <li class="py-2 text-sm">
                        <a class="cursor-pointer hover:text-orange-500 capitalize {{ $marca == $brand->name ? 'text-orange-500 font-semibold' : '' }}" wire:click="$set('marca', '{{ $brand->name }}')">{{ $brand->name }}</a>
                    </li>
                @endforeach
            </ul>

            {{-- botón para reset el filtro --}}
            <x-jet-button class="mt-4" wire:click="limpiar">
                Eliminar filtros
            </x-jet-button>

        </aside>

        {{-- Toma las 4 de las 5 columnas del grid, para incluir los productos --}}
        {{-- usar 'gap-6' para separar los productos --}}
        <div class="col-span-4">
            <ul class="grid grid-cols-4 gap-6">
                @foreach ($products as $product)
                    
                    {{-- Tarjeta de cada producto                 --}}
                    <li class="bg-white rounded-lg shadow">

                        <article>

                            <figure>
                                <img class="h-48 w-full object-cover object-center" src="{{ Storage::url($product->images->first()->url) }}" alt="">
                            </figure>

                            <div class="py-4 px-6">
                                <h1 class="text-lg font-semibold">
                                    <a href="">
                                        {{ Str::limit($product->name, 20) }}
                                    </a>
                                </h1>

                                <p class="font-bold text-gray-700">US$ {{ $product->price }}</p>

                            </div>

                            {{-- <div class="absolute bottom-0 px-6">
                                <p class="font-bold text-gray-700">US$ {{ $product->price }}</p>
                            </div> --}}

                        </article>
                        
                    </li>

                @endforeach

            </ul>

            {{-- para recuperar los links de la pagination --}}
            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>

    </div>

</div>

