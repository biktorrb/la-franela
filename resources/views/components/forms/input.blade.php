@props([
    'name' => '',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'label' => '',
    'required' => false,
    'disabled' => false,
    'dblclickEditable' => false,
    'class' => '',
])

@php
    $hasEditable = $dblclickEditable && $disabled;
@endphp

<div 
    @if ($hasEditable) 
        x-data="{ editable: false }" 
        @dblclick="editable = true" 
    @endif 
    class="mb-4 relative group"
>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}" 
        value="{{ old($name, $value) }}" 
        placeholder="{{ $placeholder }}"

        @if ($hasEditable)
            :disabled="!editable"
            x-bind:required="editable && {{ $required ? 'true' : 'false' }}"
            x-bind:class="editable ? 'border-blue-500' : 'bg-gray-100 cursor-not-allowed text-gray-500'"
        @else
            {{ $disabled ? 'disabled' : '' }}
            @if ($required) required @endif
        @endif

        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
               focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm {{ $class }}"
        {{ $attributes->except(['required', 'disabled']) }}
    >

    @if ($hasEditable)
        <div 
            x-show="!editable"
            class="absolute top-0 right-0 mt-6 mr-2 text-xs text-gray-400 group-hover:opacity-100 opacity-0 transition"
        >
            Doble clic para editar
        </div>
    @endif

    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
