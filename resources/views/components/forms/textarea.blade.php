@props(['name'])

<label for="{{ $name }}">
    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        placeholder="@if($attributes['required']) * @endif Enter a note"
        {{ $attributes(['class' => 'border rounded-md mt-5 p-3']) }}
    >{{ $slot }}</textarea>
</label>
