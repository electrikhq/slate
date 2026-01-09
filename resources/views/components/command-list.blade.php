{{-- command-list.blade.php --}}
@props([])

<div
    {{ $attributes->merge(['class' => 'max-h-[300px] overflow-y-auto overflow-x-hidden p-1']) }}
>
    {{ $slot }}
</div>

