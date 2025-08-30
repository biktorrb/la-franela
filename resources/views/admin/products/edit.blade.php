<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar ').$product->name }}
        </h2>
    </x-slot>
    <x-slot name="main_content">
        <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">                
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.products.update', $product->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-forms.input name="name" label="Nombre del Producto" :placeholder="$product->name" required disabled dblclickEditable/>
                            <x-forms.textarea name="description" label="Descripción" :placeholder="$product->description" required disabled dblclickEditable/>
                            <x-forms.select name="category_id" label="Categoría" :options="$categories" :selected="$product->category_id" required disabled dblclickEditable/>
                            <x-forms.select name="maker_id" label="Fabricante" :options="$makers" :selected="$product->maker_id" required disabled dblclickEditable/>
                            <x-forms.select name="is_active" label="Esta Activo" :options="[1 => 'Si', 0 => 'No']" :selected="$product->is_active" required disabled dblclickEditable/>
                            <x-forms.select name="is_featured" label="Esta Desctacado" :options="[1 => 'Si', 0 => 'No']" :selected="$product->is_featured" required disabled dblclickEditable/>        
                        </div>
                        <div class="mt-4">
                            <x-forms.button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold">
                                Actualizar Producto
                            </x-forms.button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>
</x-admin-layout>