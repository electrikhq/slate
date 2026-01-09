{{-- collapsible-trigger.blade.php --}}
@props([
    'as' => 'div', // Default to div to allow wrapping buttons
])

@if ($as === 'button')
    <button
        type="button"
        @click="toggle()"
        :aria-expanded="open"
        :aria-controls="$id('collapsible-content')"
        {{ $attributes->merge([
            'class' => 'inline-flex items-center justify-center rounded-md border border-input bg-background px-4 py-2 text-sm font-medium ring-offset-background transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50'
        ]) }}
    >
        {{ $slot }}
    </button>
@else
    <div
        role="button"
        tabindex="0"
        @click="toggle()"
        @keydown.enter.prevent="toggle()"
        @keydown.space.prevent="toggle()"
        :aria-expanded="open"
        :aria-controls="$id('collapsible-content')"
        {{ $attributes->merge([
            'class' => 'cursor-pointer'
        ]) }}
    >
        {{ $slot }}
    </div>
@endif

