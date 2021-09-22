@props(['name'])

@error($name)
    <div class="text-red-700 py-1">
        <p>{{ $message }}</p>
    </div>
@enderror
