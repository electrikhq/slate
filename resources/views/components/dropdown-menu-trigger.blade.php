{{-- dropdown-menu-trigger.blade.php --}}
@props([
    'as' => 'div',
])

@if ($as === 'button')
    <button
        type="button"
        @click="open = !open"
        :aria-expanded="open"
        aria-haspopup="true"
        {{ $attributes->merge(['class' => 'inline-flex items-center justify-center']) }}
    >
        {{ $slot }}
    </button>
@else
    <div
        role="button"
        tabindex="0"
        @click="open = !open"
        @keydown.enter.prevent="open = !open"
        @keydown.space.prevent="open = !open"
        :aria-expanded="open"
        aria-haspopup="true"
        {{ $attributes->merge(['class' => 'inline-block']) }}
    >
        {{ $slot }}
    </div>
@endif

