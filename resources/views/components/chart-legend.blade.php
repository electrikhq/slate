{{-- chart-legend.blade.php --}}
@props([])

<div
    {{ $attributes->merge([
        'class' => 'flex flex-wrap items-center justify-center gap-4 mt-4'
    ]) }}
>
    {{ $slot }}
</div>

