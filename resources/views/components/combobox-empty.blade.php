{{-- combobox-empty.blade.php --}}
@props([])

<div
    {{ $attributes->merge(['class' => 'py-6 text-center text-sm text-muted-foreground']) }}
>
    {{ $slot }}
</div>

