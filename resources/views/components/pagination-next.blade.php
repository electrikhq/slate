@props([
    'as' => 'a',
    'href' => '#',
])

<x-slate::pagination-link
    :as="$as"
    :href="$href"
    size="default"
    aria-label="Go to next page"
    {{ $attributes->merge(['class' => 'gap-1 pe-2.5']) }}
>
    <span class="hidden sm:inline">Next</span>
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="size-4 rtl:rotate-180" aria-hidden="true">
        <path d="m9 18 6-6-6-6" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
</x-slate::pagination-link>
