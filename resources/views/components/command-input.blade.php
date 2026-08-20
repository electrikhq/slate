@props([
    'placeholder' => 'Search...',
    'as' => 'input',
])

<{{ $as }}
    type="text"
    data-slot="command-input"
    placeholder="{{ $placeholder }}"
    x-model="query"
    {{ $attributes->merge(['class' => 'flex h-10 w-full rounded-md bg-transparent py-3 text-sm outline-hidden placeholder:text-muted-foreground disabled:cursor-not-allowed disabled:opacity-50']) }}
/>
