{{-- toggle.blade.php --}}
@props([
    'pressed' => false,
    'disabled' => false,
    'size' => 'md', // sm, md, lg
    'variant' => 'default', // default, outline
])

@php
    $sizeClasses = [
        'sm' => 'h-9 px-2.5 text-xs',
        'md' => 'h-10 px-3 text-sm',
        'lg' => 'h-11 px-4 text-base',
    ][$size];

    $baseClasses = 'inline-flex items-center justify-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50';
    
    $variantClasses = [
        'default' => [
            'unpressed' => 'bg-transparent hover:bg-muted hover:text-muted-foreground',
            'pressed' => 'bg-muted text-muted-foreground',
        ],
        'outline' => [
            'unpressed' => 'border border-input bg-transparent hover:bg-accent hover:text-accent-foreground',
            'pressed' => 'border border-input bg-accent text-accent-foreground',
        ],
    ];
    
    $variantClass = $variantClasses[$variant] ?? $variantClasses['default'];
    $stateClass = $pressed ? $variantClass['pressed'] : $variantClass['unpressed'];
@endphp

<button
    type="button"
    role="switch"
    :aria-pressed="{{ $pressed ? 'true' : 'false' }}"
    @if($disabled) disabled @endif
    x-data="{
        pressed: {{ $pressed ? 'true' : 'false' }},
        toggle() {
            if (!this.$el.disabled) {
                this.pressed = !this.pressed;
            }
        }
    }"
    @click="toggle()"
    :class="pressed ? '{{ $baseClasses }} {{ $sizeClasses }} {{ $variantClass['pressed'] }}' : '{{ $baseClasses }} {{ $sizeClasses }} {{ $variantClass['unpressed'] }}'"
    {{ $attributes->except(['pressed', 'disabled', 'size', 'variant']) }}
>
    {{ $slot }}
</button>

