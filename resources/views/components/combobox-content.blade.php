@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="combobox-content"
    role="listbox"
    x-bind:id="listboxId"
    x-show="open"
    x-cloak
    x-transition.opacity.duration.100ms
    {{ $attributes->merge(['class' => 'absolute z-50 mt-1 max-h-60 w-full overflow-auto rounded-md border bg-popover p-1 text-popover-foreground shadow-md']) }}
>
    {{ $slot }}
</{{ $as }}>
