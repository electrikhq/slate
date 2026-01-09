{{-- menubar-shortcut.blade.php --}}
@props([])

<span
    {{ $attributes->merge(['class' => 'ml-auto text-xs tracking-widest text-muted-foreground']) }}
>
    {{ $slot }}
</span>

