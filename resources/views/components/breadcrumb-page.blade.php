{{-- breadcrumb-page.blade.php --}}
@props([])

<span
    role="link"
    aria-disabled="true"
    aria-current="page"
    {{ $attributes->merge(['class' => 'font-normal text-foreground']) }}
>
    {{ $slot }}
</span>

