<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{config('app.name').__(' - Productos')}}
        </h2>
    </x-slot>
    <x-slot name="main_content">
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">Agregar Producto</h1>
            <div class="mt-4">
                <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700">
                    <i class="fas fa-plus mr-2"></i> Agregar Nuevo Producto
                </a>
            </div>
             @php
            $rows = [
                fn($item) => $item->id,
                fn($item) => $item->name,
                fn($item) => '<div class="flex space-x-2">
                                <a href="/products/'.$item->id.'" class="text-blue-600 hover:underline mr-2"><i class="fas fa-eye"></i></a>
                                <a href="/products/'.$item->id.'/edit" class="text-yellow-600 hover:underline"><i class="fas fa-pen-to-square"></i></a>
                                <form method="POST" action="/products/'.$item->id.'" onsubmit="return confirm(\'¿Desea desahabilitar este producto?\');" style="display:inline;">
                                    '.csrf_field().method_field('DELETE').'
                                    <button type="submit" class="text-red-600 hover:underline ml-2"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>',
            ];
            @endphp
            <x-data-table
                :headers="['ID', 'Nombre', 'Acciones']"
                :data="$products"
                :rows="$rows"
            />
        </div>    
    </x-slot>
</x-admin-layout>