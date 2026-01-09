{{-- navigation-menu-list.blade.php --}}
@props([])

<ul
    {{ $attributes->merge(['class' => 'group flex flex-1 list-none items-center justify-center space-x-1']) }}
>
    {{ $slot }}
</ul>

