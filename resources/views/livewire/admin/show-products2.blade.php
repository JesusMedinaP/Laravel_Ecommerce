<div>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                Lista de productos
            </h2>
            <x-button-link class="ml-auto" href="{{route('admin.products.create')}}">
                Agregar producto
            </x-button-link>
        </div>
    </x-slot>

    <x-table-responsive>

        <div class="px-6 py-4">
            <x-jet-input class="w-full"
                         wire:model="search"
                         type="text"
                         placeholder="Introduzca el nombre del producto a buscar">
            </x-jet-input>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-4 px-6 py-4">
            <x-jet-label value="Filtros:" class="text-xl"></x-jet-label>
            <label for="filters"><input type="checkbox" wire:model="showFilters" id="filters"></label>
        </div>

        @if($showFilters)
        <div class="grid grid-cols-2 gap-6 mb-4 px-6 py-4">
                <x-jet-label value="Paginación:" class="text-xl"></x-jet-label>
                <select class="w-full form-control" wire:model="pagination">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-4 px-6 py-4">
            <x-jet-label value="Columnas:" class="text-xl"></x-jet-label>
            <div class="form-group form-check">
            <label for="name"><input type="checkbox" wire:model="name" id="name">Nombre</label>
            <label for="category"><input type="checkbox" wire:model="category" id="category">Categoría</label>
            <label for="brand"><input type="checkbox" wire:model="brand" id="brand">Marca</label>
            <label for="sold"><input type="checkbox" wire:model="sold" id="sold">Vendidos</label>
            <label for="stock"><input type="checkbox" wire:model="stock" id="stock">Stock</label>
            <label for="date"><input type="checkbox" wire:model="date" id="date">Date</label>
            <label for="state"><input type="checkbox" wire:model="state" id="state">Estado</label>
            <label for="price"><input type="checkbox" wire:model="price" id="price">Precio</label>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-4 px-6 py-4">
            <x-jet-label value="Ordenar:" class="text-xl"></x-jet-label>
            <div class="form-group form-check">
            <th scope="col">
                <button type="button" class="bg-green-200 font-bold">
                    <a href="#" wire:click.prevent="sortBy('name')">Nombre</a>
                </button>
            </th>

            <th scope="col">
                <button type="button" class="bg-green-200 font-bold">
                    <a href="#" wire:click.prevent="sortBy('price')">Precio</a>
                </button>
            </th>

            <th scope="col">
                <button type="button" class="bg-green-200 font-bold">
                    <a href="#" wire:click.prevent="sortBy('name')">Categoría</a>
                </button>
            </th>

            <th scope="col">
                <button type="button" class="bg-green-200 font-bold">
                    <a href="#" wire:click.prevent="sortBy('name')">Marca</a>
                </button>
            </th>
        </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-4 px-6 py-4">
        <div class="form-group">
            <label for="categoryFilter">Categoría:</label>
            <select wire:model = "selectedCategory" id="categoryFilter" class="form-control">
                <option value="">Todas las Categorías</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="brandFilter">Marca:</label>
            <select wire:model = "selectedBrand" id="brandFilter" class="form-control">
                <option value="">Todas las Marcas</option>
                @foreach($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="priceFilter">Precio:</label>
            <select wire:model = "selectedPrice" id="priceFilter" class="form-control">
                <option value="">Todos los Precios</option>
                <option value="19.99">19.99 €</option>
                <option value="49.99">49.99 €</option>
                <option value="99.99">99.99 €</option>
            </select>
        </div>

        <div class="form-group">
            <label for="dateFilter">Fecha de creación:</label>
            <input type="date" wire:model="selectedDate" id="dateFilter" class="form-control">
        </div>

        </div>
        @endif

        @if($products->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    @if($name)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nombre
                    </th>
                    @endif

                    @if($category)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Categoría
                    </th>
                    @endif

                    @if($brand)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Marca
                    </th>
                    @endif

                    @if($sold)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Vendidos
                    </th>
                    @endif

                    @if($stock)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Stock
                    </th>
                    @endif

                     @if($date)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Fecha Creación
                    </th>
                    @endif

                    @if($state)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Estado
                    </th>
                    @endif

                    @if($price)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Precio
                    </th>
                    @endif

                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Editar</span>
                    </th>

                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($products as $product)
                    <tr>
                        @if($name)
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 object-cover">
                                    <img class="h-10 w-10 rounded-full" src="{{ Storage::url($product->images->first()->url) }}" alt="">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $product->name }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        @endif

                            @if($category)
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $product->subcategory->category->name }}</div>
                            <div class="text-sm text-gray-500">{{ $product->subcategory->name }}</div>
                        </td>
                            @endif

                            @if($brand)
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $product->brand->name }}</div>
                        </td>
                            @endif

                            @if($sold)
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $product->solded }}</div>
                        </td>
                            @endif

                            @if($stock)
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $product->stock }}</div>
                        </td>
                            @endif

                            @if($date)
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $product->created_at->format('d-m-Y') }}</div>
                        </td>
                            @endif

                            @if($state)
                        <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $product->status == 1 ? 'red' : 'green'}}-100 text-{{ $product->status == 1 ? 'red' : 'green' }}-800">
                            {{ $product->status == 1 ? 'Borrador' : 'Publicado' }}
                        </span>
                        </td>
                            @endif

                            @if($price)
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $product->price }} &euro;
                        </td>
                            @endif

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        @else
            <div class="px-6 py-4">
                No existen productos coincidentes
            </div>
        @endif

        @if($products->hasPages())
            <div class="px-6 py-4">
                {{ $products->links() }}
            </div>
        @endif

    </x-table-responsive>

</div>
