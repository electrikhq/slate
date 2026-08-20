@props([
    'placeholder' => 'Search...',
    'as' => 'input',
])

<{{ $as }}
    type="text"
    data-slot="combobox-input"
    role="combobox"
    x-bind:aria-expanded="open ? 'true' : 'false'"
    x-model="query"
    placeholder="{{ $placeholder }}"
    @focus="open = true"
    @input="open = true"
    @click="open = true"
    {{ $attributes->merge(['class' => 'flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-xs transition-[color,box-shadow] outline-none placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:cursor-not-allowed disabled:opacity-50']) }}
/>
