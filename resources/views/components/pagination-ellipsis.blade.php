{{-- pagination-ellipsis.blade.php --}}
@props([])

<li
    role="presentation"
    aria-hidden="true"
    {{ $attributes->merge(['class' => 'flex h-10 w-10 items-center justify-center']) }}
>
    <span class="text-muted-foreground">...</span>
</li>

