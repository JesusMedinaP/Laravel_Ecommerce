<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-600">
            Lista de productos
        </h2>
    </x-slot>

    <x-table-responsive>

        <div class="px-6 py-4">
            <x-jet-input class="w-full"
                         wire:model="search"
                         type="text"
                         placeholder="Introduzca el nombre del producto a buscar">
            </x-jet-input>
        </div>


        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Product name
                </th>
                <th scope="col" class="px-6 py-3">
                    Color
                </th>
                <th scope="col" class="px-6 py-3">
                    Category
                </th>
                <th scope="col" class="px-6 py-3">
                    Price
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($products as $product)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    ...
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $products->links() }}
        </div>

    </x-table-responsive>

</div>
