@props([
    'defaultOpen' => true,
    'as' => 'div',
])

@php
    $isOpen = filter_var($defaultOpen, FILTER_VALIDATE_BOOL);
@endphp

<{{ $as }}
    data-slot="sidebar-provider"
    x-data="{ open: {{ $isOpen ? 'true' : 'false' }} }"
    {{ $attributes->merge(['class' => 'group/sidebar-wrapper relative flex h-full min-h-0 w-full overflow-hidden']) }}
>
    {{ $slot }}
</{{ $as }}>
