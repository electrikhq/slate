{{-- combobox-trigger.blade.php --}}
@props([
    'as' => 'div',
])

@if ($as === 'button')
    <button
        type="button"
        @click="open = !open"
        :aria-expanded="open"
        aria-haspopup="listbox"
        {{ $attributes->merge(['class' => 'inline-flex items-center justify-center']) }}
    >
        {{ $slot }}
    </button>
@else
    <div
        role="combobox"
        :aria-expanded="open"
        aria-haspopup="listbox"
        {{ $attributes->merge(['class' => 'inline-block']) }}
    >
        {{ $slot }}
    </div>
@endif

