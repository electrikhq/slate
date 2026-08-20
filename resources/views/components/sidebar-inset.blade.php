@props(['as' => 'main'])

<{{ $as }}
    data-slot="sidebar-inset"
    {{ $attributes->merge(['class' => 'relative flex min-h-0 min-w-0 flex-1 flex-col bg-background']) }}
>
    {{ $slot }}
</{{ $as }}>
