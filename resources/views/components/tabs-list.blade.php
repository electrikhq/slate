{{-- tabs-list.blade.php --}}
@props([])

<div
    role="tablist"
    {{ $attributes->merge([
        'class' => 'inline-flex h-10 items-center justify-center rounded-md bg-muted p-1 text-muted-foreground'
    ]) }}
>
    {{ $slot }}
</div>

