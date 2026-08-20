@props([
    'as' => 'li',
])

<{{ $as }}
    data-slot="breadcrumb-separator"
    role="presentation"
    aria-hidden="true"
    {{ $attributes->merge(['class' => '[&>svg]:size-3.5']) }}
>
    @if($slot->isNotEmpty())
        {{ $slot }}
    @else
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" class="rtl:rotate-180">
            <path d="m9 18 6-6-6-6" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    @endif
</{{ $as }}>
