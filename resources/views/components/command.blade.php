{{-- command.blade.php --}}
@props([
    'id' => 'command-' . uniqid(),
])

<div
    x-data="{
        search: '',
        selectedIndex: 0,
        id: '{{ $id }}'
    }"
    x-id="['command']"
    wire:ignore
    {{ $attributes->merge(['class' => 'relative']) }}
>
    {{ $slot }}
</div>

