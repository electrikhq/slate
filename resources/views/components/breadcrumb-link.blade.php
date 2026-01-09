{{-- breadcrumb-link.blade.php --}}
@props([
    'href' => '#',
    'as' => 'a',
])

@if ($as === 'a')
    <a
        href="{{ $href }}"
        {{ $attributes->merge(['class' => 'transition-colors hover:text-foreground']) }}
    >
        {{ $slot }}
    </a>
@else
    <div
        role="link"
        tabindex="0"
        {{ $attributes->merge(['class' => 'transition-colors hover:text-foreground cursor-pointer']) }}
    >
        {{ $slot }}
    </div>
@endif

