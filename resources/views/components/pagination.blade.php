{{-- pagination.blade.php --}}
@props([])

<nav
    role="navigation"
    aria-label="Pagination"
    {{ $attributes->merge(['class' => 'mx-auto flex w-full justify-center']) }}
>
    {{ $slot }}
</nav>

