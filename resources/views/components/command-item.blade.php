@props([
    'value' => '',
    'as' => 'div',
])

<{{ $as }}
    data-slot="command-item"
    role="option"
    data-value="{{ $value }}"
    x-show="!query || '{{ strtolower($value) }}'.includes(query.toLowerCase()) || $el.textContent.toLowerCase().includes(query.toLowerCase())"
    @click="query = ''"
    {{ $attributes->merge(['class' => 'relative flex cursor-default items-center gap-2 rounded-sm px-2 py-1.5 text-sm outline-hidden select-none hover:bg-accent hover:text-accent-foreground aria-selected:bg-accent aria-selected:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50']) }}
>
    {{ $slot }}
</{{ $as }}>
