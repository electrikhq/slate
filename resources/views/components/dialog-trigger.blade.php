{{-- dialog-trigger.blade.php --}}
@props([
    'as' => 'div',
])

@if ($as === 'button')
    <button
        type="button"
        @click="open = true"
        {{ $attributes->merge([
            'class' => 'inline-flex items-center justify-center'
        ]) }}
    >
        {{ $slot }}
    </button>
@else
    <div
        role="button"
        tabindex="0"
        @click="open = true"
        @keydown.enter.prevent="open = true"
        @keydown.space.prevent="open = true"
        {{ $attributes->merge([
            'class' => 'inline-block'
        ]) }}
    >
        {{ $slot }}
    </div>
@endif
