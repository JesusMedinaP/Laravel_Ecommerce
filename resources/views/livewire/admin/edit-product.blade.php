<div>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
    <h1 class="text-3xl text-center font-semibold mb-8">Complete los datos para modificar un producto</h1>

    <div class="mb-4" wire:ignore>
        <form action="{{ route('admin.products.files', $product) }}"
              method="POST"
              class="dropzone"
              id="my-awesome-dropzone">
        </form>
    </div>

    @if ($product->images->count())
        <section class="bg-white shadow-xl rounded-lg p-6 mb-4">
            <h1 class="text-2xl text-center font-semibold mb-2">Imagenes del producto</h1>
            <ul class="flex flex-wrap">
                @foreach ($product->images as $image)
                    <li class="relative" wire:key="image-{{ $image->id }}">
                        <img
                            class="h-10 w-10 rounded-full"
                            src="{{ $product->images->count() ? Storage::url($product->images->first()->url) : 'img/default.jpg' }}"
                            alt="">
                        <x-jet-danger-button class="absolute right-2 top-2 w-6 h-4"
                                             wire:click="deleteImage({{ $image->id }})" wire:loading.attr="disabled"
                                             wire:target="deleteImage({{ $image->id }})">
                            x
                        </x-jet-danger-button>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif

    @livewire('admin.status-product', ['product' => $product], key('status-product-' . $product->id))

    <div class="bg-white shadow-xl rounded-lg p-6 mb-4">
        <p class="text-2xl text-center font-semibold mb-2">Estado del producto</p>
        <div class="flex">
            <label class="mr-6">
                <input wire:model.defer="status" type="radio" name="status" value="1">
                Marcar producto como borrador
            </label>
            <label>
                <input wire:model.defer="status" type="radio" name="status" value="2">
                Marcar producto como publicado
            </label>
        </div>
        <div class="flex justify-end items-center">
            <x-jet-action-message class="mr-3" on="saved">
                Actualizado
            </x-jet-action-message>
            <x-jet-button wire:click="save"
                          wire:loading.attr="disabled"
                          wire:target="save">
                Actualizar
            </x-jet-button>
        </div>
    </div>

    <div class="bg-white shadow-xl rounded-lg p-6">

    <div class="grid grid-cols-2 gap-6 mb-4">
        <div>
            <x-jet-label value="Categorías"></x-jet-label>
            <select class="w-full form-control" wire:model="category_id">
                <option value="" selected disabled>Seleccione una categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="category_id" />
        </div>
        <div>
            <x-jet-label value="Subcategorías"></x-jet-label>
            <select class="w-full form-control" wire:model="product.subcategory_id">
                <option value="" selected disabled>Seleccione una subcategoría</option>
                @foreach($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="product.subcategory_id" />
        </div>
    </div>

    <div class="mb-4">
        <div class="mb-4">
            <x-jet-label value="Nombre"/>
            <x-jet-input type="text"
                         class="w-full"
                         wire:model="product.name"
                         placeholder="Ingrese el nombre del producto"/>
            <x-jet-input-error for="product.name" />
        </div>
    </div>
    <div class="mb-4">
        <x-jet-label value="Slug"></x-jet-label>
        <x-jet-input type="text"
                     disabled
                     wire:model="product.slug"
                     class="w-full bg-gray-200"
                     placeholder="Ingrese el slug del producto">
            <x-jet-input-error for="product.slug" />
        </x-jet-input>
    </div>

    <div class="mb-4">
        <div wire:ignore>
            <x-jet-label value="Descripción" />
            <textarea class="w-full form-control" rows="4"
                      wire:model="product.description"
                      x-data
                      x-init="ClassicEditor.create($refs.miEditor)
                      .then(function(editor){editor.model.document.on('change:data',
                      () => {@this.set('product.description', editor.getData())
                      })
                      })
                      .catch( error => {console.error( error );
                      }
                      );"
                      x-ref="miEditor">
            </textarea>
            <x-jet-input-error for="product.description" />
        </div>
    </div>

    <div class="grid grid-cols-2 gap-6 mb-4">
        <div class="mb-4">
            <x-jet-label value="Marca" />
            <select class="form-control w-full" wire:model="product.brand_id">
                <option value="" selected disabled>Seleccione una marca</option>
                @foreach ($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                @endforeach
            </select>
            <x-jet-input-error for="product.brand_id" />
        </div>

        <div>
            <x-jet-label value="Precio" />
            <x-jet-input
                wire:model="product.price"
                type="number"
                class="w-full"
                step=".01" />
            <x-jet-input-error for="product.price" />
        </div>
    </div>

    @if ($this->subcategory && !$this->subcategory->color && !$this->subcategory->size)
        <div>
            <x-jet-label value="Cantidad" />
            <x-jet-input
                wire:model="product.quantity"
                type="number"
                class="w-full" />
            <x-jet-input-error for="product.quantity" />
        </div>
    @endif

    <div class="flex mt-4 justify-end items-center">

        <x-jet-action-message class="mr-3" on="saved">
            Actualizado
        </x-jet-action-message>

        <x-jet-button
            wire:loading.attr="disabled"
            wire:target="save"
            wire:click="save"
            class="ml-auto">
            Actualizar producto
        </x-jet-button>
    </div>

    </div>
</div>

@if($this->subcategory)
    @if($this->subcategory->size)
        @livewire('admin.size-product', ['product' => $product], key('size-product-' . $product->id))
    @elseif($this->subcategory->color)
        @livewire('admin.color-product', ['product' => $product], key('color-product-' . $product->id))
    @endif
@endif


@push('scripts')
    <script>
        const { Dropzone } = require("dropzone");

        Dropzone.options.myAwesomeDropzone = {
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            dictDefaultMessage: "Mueva una imagen al recuadro",
            acceptedFiles: 'image/*',
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 2, // MB
            complete: function(file) {
                this.removeFile(file);
            },
            queuecomplete: function() {
                Livewire.emit('refreshProduct');
            }
        };

        Livewire.on('deleteSize', sizeId => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('admin.size-product','delete', sizeId);
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        })

        Livewire.on('errorSize', mensaje => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: mensaje,
            }) /* */
        });


        Livewire.on('deleteColor', pivot => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('admin.color-product','delete', pivot);
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        })

        Livewire.on('deleteColorSize', pivot => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('admin.color-size', 'delete', pivot);
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        })


        Livewire.on('deleteProduct', () => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('admin.edit-product', 'delete');
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        })

    </script>
@endpush

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Productos
                </h1>
                <x-jet-danger-button wire:click="$emit('deleteProduct')">
                    Eliminar
                </x-jet-danger-button>
            </div>
        </div>
    </header>
</div>
