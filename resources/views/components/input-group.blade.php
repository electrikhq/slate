@props([
    'size' => 'default',
    'disabled' => false,
])

@php
    // Size classes for addon elements
    $sizeClasses = [
        'sm' => 'h-9 text-sm px-3',
        'default' => 'h-10 text-sm px-3',
        'lg' => 'h-11 text-sm px-4',
    ];
    
    $addonSizeClass = $sizeClasses[$size] ?? $sizeClasses['default'];
    
    // Check if prefix or suffix slots have content
    $hasPrefix = isset($prefix);
    $hasSuffix = isset($suffix);
    
    // Build wrapper classes - flex container with proper border radius
    $wrapperClasses = 'inline-flex items-center w-full rounded-md border border-input bg-background ring-offset-background focus-within:ring-2 focus-within:ring-ring focus-within:ring-offset-2 overflow-hidden';
    
    // Add disabled state
    if ($disabled) {
        $wrapperClasses .= ' opacity-50 cursor-not-allowed';
    }
    
    // Input wrapper - remove border and adjust radius
    $inputWrapperClass = 'flex-1 [&>div]:border-0 [&>div]:rounded-none [&_input]:border-0 [&_input]:rounded-none [&_input]:shadow-none [&_input]:focus-visible:ring-0 [&_input]:focus-visible:ring-offset-0';
    
    // Adjust input border radius based on addons
    if ($hasPrefix && !$hasSuffix) {
        $inputWrapperClass .= ' [&_input]:rounded-r-md';
    } elseif (!$hasPrefix && $hasSuffix) {
        $inputWrapperClass .= ' [&_input]:rounded-l-md';
    } elseif (!$hasPrefix && !$hasSuffix) {
        $inputWrapperClass .= ' [&_input]:rounded-md';
    }
@endphp

<div class="w-full">
    {{-- Label is handled by the Input component --}}
    
    <div class="{{ $wrapperClasses }}">
        {{-- Prefix Addon --}}
        @if($hasPrefix)
            <span class="inline-flex items-center {{ $addonSizeClass }} border-r border-input text-muted-foreground bg-muted/50 {{ $disabled ? 'cursor-not-allowed' : '' }}">
                {{ $prefix }}
            </span>
        @endif
        
        {{-- Input Component --}}
        <div class="{{ $inputWrapperClass }}">
            {{ $slot }}
        </div>
        
        {{-- Suffix Addon --}}
        @if($hasSuffix)
            <span class="inline-flex items-center {{ $addonSizeClass }} border-l border-input text-muted-foreground bg-muted/50 {{ $disabled ? 'cursor-not-allowed' : '' }}">
                {{ $suffix }}
            </span>
        @endif
    </div>
    
    {{-- Help text and error messages are handled by the Input component --}}
</div>

