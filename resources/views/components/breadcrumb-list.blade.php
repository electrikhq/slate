{{-- breadcrumb-list.blade.php --}}
@props([])

<ol
    {{ $attributes->merge(['class' => 'flex flex-wrap items-center gap-1.5 break-words text-sm text-muted-foreground sm:gap-2.5']) }}
>
    {{ $slot }}
</ol>

