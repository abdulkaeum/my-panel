@props(['name', 'type' => 'text'])

<div class="mt-2">
    <label for="{{ $name }}">
        {{ ucwords($name) }}
        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded"
               name="{{ $name }}"
               id="{{ $name }}"
               type="{{ $type }}"
               value="{{ old($name) }}"
              {{ $attributes }}
        >
    </label>
    <x-forms.error name="{{ $name }}" />
</div>
