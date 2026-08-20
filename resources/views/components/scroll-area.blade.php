@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="scroll-area"
    {{ $attributes->merge(['class' => 'relative']) }}
>
    <div
        data-slot="scroll-area-viewport"
        class="size-full rounded-[inherit] overflow-auto [scrollbar-width:thin] [scrollbar-color:var(--slate-border)_transparent]"
    >
        {{ $slot }}
    </div>
</{{ $as }}>
