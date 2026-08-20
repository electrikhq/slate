@props([
    'value' => '',
    'label' => null,
    'description' => null,
    'disabled' => false,
    'as' => 'label',
])

@php
    $isDisabled = filter_var($disabled, FILTER_VALIDATE_BOOL);
    $itemId = $attributes->get('id') ?? 'radio-group-item-'.md5((string) $value).'-'.uniqid();

    $classes = trim(implode(' ', [
        'flex gap-3 cursor-pointer',
        filled($description) ? 'items-start' : 'items-center',
        $isDisabled ? 'cursor-not-allowed opacity-50' : '',
    ]));
@endphp

<{{ $as }}
    data-slot="radio-group-item"
    for="{{ $itemId }}"
    {{ $attributes->merge(['class' => $classes]) }}
>
    <span class="relative inline-flex shrink-0 align-middle">
        <input
            type="radio"
            id="{{ $itemId }}"
            value="{{ $value }}"
            @if($isDisabled) disabled @endif
            x-model="value"
            class="peer absolute inset-0 z-10 m-0 size-4 cursor-pointer opacity-0 disabled:cursor-not-allowed"
        />
        <span
            aria-hidden="true"
            class="inline-flex size-4 items-center justify-center rounded-full border border-primary shadow-xs transition-[color,box-shadow,background-color,border-color] outline-none peer-focus-visible:border-ring peer-focus-visible:ring-[3px] peer-focus-visible:ring-ring/50 peer-disabled:opacity-50 peer-checked:[&_span]:scale-100 peer-checked:[&_span]:opacity-100"
        >
            <span class="size-2 scale-0 rounded-full bg-primary opacity-0 transition-all"></span>
        </span>
    </span>

    @if(filled($label) || filled($description))
        <span class="grid gap-1.5 leading-none">
            @if(filled($label))
                <span class="text-sm font-medium leading-none">{{ $label }}</span>
            @endif
            @if(filled($description))
                <span class="text-sm text-muted-foreground">{{ $description }}</span>
            @endif
        </span>
    @else
        {{ $slot }}
    @endif
</{{ $as }}>
