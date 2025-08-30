<x-admin-layout>    <
    <x-slot name="main_content">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Crear Nueva Variante de Producto') }}
                </h2>
            </x-slot>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-forms.form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                            <x-forms.input-autocomplete 
                                fetchUrl="{{ route('api.products.search') }}" 
                                valueField="id" 
                                labelField="name" 
                                onSelect="(item) => { console.log('Producto seleccionado:', item) }"
                                placeholder="Buscar producto..."
                            />
                            
                            <x-forms.button>Agregar Producto</x-forms.button>
                        </x-forms.form>
                    </div>
                </div>
            </div>
        </div>  
    </x-slot>
</x-admin-layout>