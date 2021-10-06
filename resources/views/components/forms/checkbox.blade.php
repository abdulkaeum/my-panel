@props(['name', 'description', 'isChecked' => false, 'description' => false])

<div class="mt-5">
    @if($attributes['required']) <span class="text-red-500">*</span> @endif
    <label for="{{ $name }}" class="inline-flex items-center">
        <input
            type="checkbox"
            class="form-checkbox"
            name="{{ $name }}"
            id="{{ $name }}"
            {{ $isChecked ? ' checked ' : '' }}
            {{ $attributes }}
        >
        <span class="ml-2 {{ $description ? '' : 'hidden' }}">{{ $description }}</span>
    </label>
</div>
