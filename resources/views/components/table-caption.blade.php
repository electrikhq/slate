{{-- table-caption.blade.php --}}
@props([])

<caption
    {{ $attributes->merge(['class' => 'mt-4 text-sm text-muted-foreground']) }}
>
    {{ $slot }}
</caption>

