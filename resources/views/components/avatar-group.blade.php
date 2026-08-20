@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="avatar-group"
    {{ $attributes->merge(['class' => 'group/avatar-group flex -space-x-2 rtl:space-x-reverse *:data-[slot=avatar]:ring-2 *:data-[slot=avatar]:ring-background']) }}
>
    {{ $slot }}
</{{ $as }}>
