@props(['as' => 'div'])

<{{ $as }}
    data-slot="menubar-separator"
    role="separator"
    {{ $attributes->merge(['class' => 'bg-border -mx-1 my-1 h-px']) }}
></{{ $as }}>
