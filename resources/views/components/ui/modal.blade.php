@props([
    'triggerText' => 'Abrir',
    'modalTitle' => 'Título del Modal',
    'confirmText' => 'Aceptar',
    'confirmClass' => 'bg-blue-600 text-white',
    'btnClass' => 'bg-blue-600 text-white',
    'buttonType' => 'button',
    'modalForm' => false,
    'formId' => null,
    'formMethod' => 'POST',
    'formAction' => '',
])

<div x-data="{ open: false }" class="inline-block">
    <!-- Botón de activación -->
    <button @click="open = true" type="button" {{ $attributes->merge(['class' => "rounded p-1 $btnClass"]) }}>
        {{ $triggerText }}
    </button>

    <!-- Modal Overlay -->
    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 overflow-y-auto">
        <!-- Modal Card -->
        <div
            @click.away="open = false"
            class="bg-white rounded-lg shadow-lg max-w-md w-full max-h-[90vh] flex flex-col"
        >
            <!-- Header (fijo) -->
            <div class="px-6 py-4 border-b flex justify-between items-center">
                <h2 class="text-lg font-bold">{{ $modalTitle }}</h2>
                <button @click="open = false" class="text-gray-400 hover:text-black text-xl">&times;</button>
            </div>

            <div class="px-6 py-4 overflow-y-auto" style="max-height: 60vh;">
                @if ($modalForm && $formId)
                    <form id="{{ $formId }}" method="{{$formMethod}}" action="{{$formAction}}">                        
                        @csrf
                        {{ $slot }}
                    </form>
                @else
                    {{ $slot }}
                @endif
            </div>

            <div class="px-6 py-4 border-t flex justify-end space-x-2">
                <button @click="open = false" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancelar</button>

                <button @click="open = false"
                    {{ $attributes->merge([
                        'type' => $buttonType,
                        'class' => "px-4 py-2 $confirmClass rounded hover:bg-red-700",
                        'form' => $formId ? $formId : null,
                    ]) }}>
                    {{ $confirmText }}
                </button>
            </div>
        </div>
    </div>
</div>
</div>
