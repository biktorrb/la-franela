<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{config('app.name')}} - Productos
        </h2>
    </x-slot>
    <x-slot name="main_content">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bol">{{$product->name}}</h1>
                    <p class="text-gray-500">{{$product->description}}</p>
                    <span class="rounded p-1 bg-sky-600 text-white text-xs font-semibold">{{$product->category->name}}</span>
                    <div class="block mt-2">
                        <x-ui.modal
                            triggerText="Agregar variante"
                            modalTitle="Nueva Variante"
                            confirmText="Agregar"
                            confirmClass="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold"
                            btnClass="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold"
                            buttonType="submit"
                            wire:click="store"
                            :modalForm="true"
                            formId="productVariantForm"
                            formMethod="POST"
                            formAction="{{ route('admin.product_variants.store', $product->id) }}"
                        >
                                <x-forms.select
                                    name="size_id"
                                    label="Tamaño"
                                    :options="$sizes"
                                    :showOther="true"
                                    required	
                                >
                                    <x-slot name="other">
                                        <div class="space-y-2">                                            
                                            <x-forms.input name="size_name" label="Nombre de la Talla" required />                                            
                                            <x-forms.select 
                                                name="size_type" 
                                                label="Tipo de Talla" 
                                                :options="['Adulto', 'Niño', 'Unico']" 
                                                required
                                            />
                                        </div>
                                    </x-slot>
                                </x-forms.select>
                                <x-forms.select 
                                    name="color_id"
                                    label="Color"
                                    :options="$colors"
                                    :showOther="true"
                                    required
                                >
                                <x-forms.input name="color_name" label="Nombre del Color" required />                                
                                <x-forms.input type="color" name="color_hex" label="Selecciona el color" required />
                                </x-forms.select>
                                <x-forms.input name="stock" label="Stock Inicial" type="number" required />
                                <x-forms.input name="price" label="Precio" type="number" step="0.01" required />
                                <x-forms.input name="discount" label="Descuento (%)" type="number" step="0.01" />        
                        </x-ui.modal>
                    </div>
                    @if (session('success'))
                        <div class="mb-4 px-4 py-3 bg-green-100 text-green-800 border border-green-200 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                    @error('error')
                        <div class="mb-4 px-4 py-3 bg-red-100 text-red-800 border border-red-200 rounded">
                            {{ $message }}
                        </div>
                    @enderror
                    <x-data-table
                        :headers="['ID', 'SKU', 'Precio', 'Stock']"
                        :data="$product_variants"
                        :rows="[
                            fn($item) => $item->id,
                            fn($item) => $item->sku,
                            fn($item) => '$'.number_format($item->price, 2),
                            fn($item) => $item->stock,
                        ]"
                    />
                    <div class="mt-4">
                        <a href="{{ route('admin.products') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-semibold rounded hover:bg-gray-700">
                            <i class="fas fa-arrow-left mr-2"></i> Volver al Listado de Productos
                        </a>
                </div>
            </div>    
        </div>
    </x-slot>
</x-admin-layout>