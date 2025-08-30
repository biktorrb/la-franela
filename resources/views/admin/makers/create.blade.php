<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{config('app.name')}}
        </h2>
    </x-slot>
    <x-slot name="main_content">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Agregar un nuevo fabricantes</h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-forms.form action="{{ route('admin.makers.store') }}" method="POST" enctype="multipart/form-data">
                            <x-forms.input name="name" label="Nombre del Fabricante" required />
                            <x-forms.button>Agregar Fabricante</x-forms.button>
                        </x-forms.form>
                    </div>
            </div>
        </div>    
    </x-slot>
</x-admin-layout>