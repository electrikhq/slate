{{-- accordion-trigger.blade.php --}}
@props([
    'as' => 'button',
])

@if ($as === 'button')
    <button
        type="button"
        @click="toggleItem(itemValue)"
        :aria-expanded="isOpen(itemValue)"
        :aria-controls="'accordion-content-' + itemValue"
        {{ $attributes->merge([
            'class' => 'flex w-full items-center justify-between py-4 font-medium transition-all hover:underline [&[data-state=open]>svg]:rotate-180'
        ]) }}
    >
        {{ $slot }}
    </button>
@else
    <div
        role="button"
        tabindex="0"
        @click="toggleItem(itemValue)"
        @keydown.enter.prevent="toggleItem(itemValue)"
        @keydown.space.prevent="toggleItem(itemValue)"
        :aria-expanded="isOpen(itemValue)"
        :aria-controls="'accordion-content-' + itemValue"
        {{ $attributes->merge([
            'class' => 'flex w-full cursor-pointer items-center justify-between py-4 font-medium transition-all hover:underline [&[data-state=open]>svg]:rotate-180'
        ]) }}
    >
        {{ $slot }}
    </div>
@endif

