@props([
    'placeholder' => 'Search...',
    'as' => 'input',
])

<{{ $as }}
    type="text"
    data-slot="combobox-input"
    role="combobox"
    autocomplete="off"
    aria-autocomplete="list"
    x-bind:aria-expanded="open ? 'true' : 'false'"
    x-bind:aria-controls="listboxId"
    x-bind:aria-activedescendant="activeId()"
    x-model="query"
    placeholder="{{ $placeholder }}"
    @focus="open = true"
    @input="open = true; activeIndex = 0"
    @click="open = true"
    @keydown.arrow-down.prevent="open = true; moveActive(1)"
    @keydown.arrow-up.prevent="open = true; moveActive(-1)"
    @keydown.enter.prevent="if (open) chooseActive()"
    @keydown.home.prevent="activeIndex = 0"
    @keydown.end.prevent="activeIndex = Math.max(0, visibleOptions().length - 1)"
    {{ $attributes->merge(['class' => 'flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-xs transition-[color,box-shadow] outline-none placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:cursor-not-allowed disabled:opacity-50']) }}
/>
