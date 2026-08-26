@props([
    'value' => '',
    'as' => 'div',
])

@php
    $optionId = 'slate-option-'.substr(md5($value.spl_object_id($attributes)), 0, 10);
@endphp

<{{ $as }}
    id="{{ $optionId }}"
    data-slot="combobox-item"
    role="option"
    data-value="{{ $value }}"
    x-show="!query || ($el.dataset.value || '').toLowerCase().includes(query.toLowerCase()) || $el.textContent.toLowerCase().includes(query.toLowerCase())"
    x-bind:aria-selected="(value === $el.dataset.value) || (visibleOptions()[activeIndex] === $el) ? 'true' : 'false'"
    x-bind:data-active="visibleOptions()[activeIndex] === $el"
    @click="select($el.dataset.value || '', $el.textContent.trim())"
    {{ $attributes->merge(['class' => 'relative flex cursor-default items-center gap-2 rounded-sm px-2 py-1.5 text-sm outline-hidden select-none hover:bg-accent hover:text-accent-foreground data-[active=true]:bg-accent data-[active=true]:text-accent-foreground aria-selected:bg-accent aria-selected:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50']) }}
>
    {{ $slot }}
</{{ $as }}>
