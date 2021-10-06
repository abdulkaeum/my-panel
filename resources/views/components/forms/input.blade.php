@props(['name', 'type' => 'text'])

<div class="mt-2">
    <label for="{{ $name }}">
        @if($attributes['required']) <span class="text-red-500">*</span> @endif
        {{ ucwords(str_replace('_', ' ', $name)) }}
        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded"
               name="{{ $name }}"
               id="{{ $name }}"
               type="{{ $type }}"
              {{ $attributes(['value' => old($name)]) }}
        >
    </label>
    <x-forms.error name="{{ $name }}" />
</div>
