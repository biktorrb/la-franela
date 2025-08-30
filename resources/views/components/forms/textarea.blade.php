@props(['name', 
    'label', 
    'value' => '', 
    'required' => false, 
    'rows' => 3,
    'disabled' => false,
    'dblclickEditable' => false,
    'class' => ''
    ])

<div
    @if ($dblclickEditable && $disabled)
        x-data="{ editable: false }"
        @dblclick="editable = true"
        class="mb-4 group relative"
    @endif
>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 ' . $class]) }}
        @if ($dblclickEditable && $disabled)
            :disabled="!editable"
            x-bind:class="editable ? 'border-blue-500' : 'bg-gray-100 cursor-not-allowed text-gray-500'"
        @else
            {{ $disabled ? 'disabled' : '' }}
        @endif
    >{{ old($name, $value) }}</textarea>
    @if ($dblclickEditable && $disabled)
        <div 
            x-show="!editable"
            class="absolute top-0 right-0 mt-6 mr-2 text-xs text-gray-400 group-hover:opacity-100 opacity-0 transition"
        >
            Doble click para editar
        </div>
    @endif
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>