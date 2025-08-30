@props([
    'name',
    'label',
    'options' => [],
    'selected' => null,
    'required' => false,
    'disabled' => false,
    'dblclickEditable' => false,
    'showOther' => false,
    'class' => ''
])

@php
    $oldValue = old($name, $selected);
@endphp

<div 
    @if ($dblclickEditable && $disabled)
        x-data="{ editable: false, selected: '{{ $oldValue }}' }"
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

    <select
        name="{{ $name }}"
        id="{{ $name }}"
        x-model="selected"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge([
            'class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 ' . $class
        ]) }}
        @if ($dblclickEditable && $disabled)
            :disabled="!editable"
            x-bind:class="editable ? 'border-blue-500' : 'bg-gray-100 cursor-not-allowed text-gray-500'"
        @else
            {{ $disabled ? 'disabled' : '' }}
        @endif 
    >
        <option value="">Seleccione una opción</option>

        @foreach ($options as $value => $text)
            <option value="{{ is_object($text) ? $text->id : $value }}"
                @selected($oldValue == (is_object($text) ? $text->id : $value))>
                {{ is_object($text) ? ($text->name ?? $text->id) : $text }}
            </option>
        @endforeach

        @if ($showOther)
            <option value="other" @selected($oldValue === 'other')>Otro</option>
        @endif        
    </select>
    @if ($dblclickEditable && $disabled)
        <div 
            x-show="!editable"
            class="absolute top-0 right-0 mt-6 mr-2 text-xs text-gray-400 group-hover:opacity-100 opacity-0 transition"
        >
            Doble click para editar
        </div>
    @endif
    @if ($showOther)
        <div x-show="selected === 'other'" x-cloak class="mt-2">
            {{ $other ?? $slot }}
        </div>
    @endif    
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
