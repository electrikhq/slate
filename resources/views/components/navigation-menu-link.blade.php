@props([
    'href' => '#',
    'as' => 'a',
])

@if($as === 'a')
<a
    href="{{ $href }}"
    data-slot="navigation-menu-link"
    {{ $attributes->merge(['class' => 'block rounded-sm p-2 text-sm transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground focus:outline-hidden']) }}
>
    {{ $slot }}
</a>
@else
<{{ $as }}
    data-slot="navigation-menu-link"
    {{ $attributes->merge(['class' => 'block rounded-sm p-2 text-sm transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground focus:outline-hidden']) }}
>
    {{ $slot }}
</{{ $as }}>
@endif
