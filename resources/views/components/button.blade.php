@props([
    'variant' => 'default',
    'size' => 'default',
    'color' => null,
    'type' => 'button',
    'loading' => false,
    'loadingText' => null,
    'showSpinner' => true,
])

@php
    // Convert string booleans to actual booleans (Blade passes strings)
    $loading = filter_var($loading, FILTER_VALIDATE_BOOLEAN);
    $showSpinner = filter_var($showSpinner, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? true;
    
    $baseClasses = 'inline-flex items-center justify-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none';
    
    // Size classes - matching shadcn/ui exactly
    $sizeClasses = [
        'sm' => 'h-9 px-3 text-sm',
        'default' => 'h-10 px-4 py-2',
        'lg' => 'h-11 px-8',
    ];
    
    // Variant classes
    $variantClasses = [
        'default' => 'bg-primary text-primary-foreground hover:bg-primary/90',
        'success' => 'bg-success text-success-foreground hover:bg-success/90',
        'warning' => 'bg-warning text-warning-foreground hover:bg-warning/90',
        'info' => 'bg-info text-info-foreground hover:bg-info/90',
        'error' => 'bg-error text-error-foreground hover:bg-error/90',
        'danger' => 'bg-danger text-danger-foreground hover:bg-danger/90',
        'outline' => 'border border-input bg-background hover:bg-accent hover:text-accent-foreground',
        'secondary' => 'bg-secondary text-secondary-foreground hover:bg-secondary/80',
        'ghost' => 'hover:bg-accent hover:text-accent-foreground',
        'link' => 'text-primary underline-offset-4 hover:underline',
    ];
    
    // Color override (if specified)
    if ($color === 'primary') {
        $variantClasses['default'] = 'bg-primary text-primary-foreground hover:bg-primary/90';
    } elseif ($color === 'secondary') {
        $variantClasses['default'] = 'bg-secondary text-secondary-foreground hover:bg-secondary/80';
    } elseif ($color === 'success') {
        $variantClasses['default'] = 'bg-success text-success-foreground hover:bg-success/90';
    } elseif ($color === 'warning') {
        $variantClasses['default'] = 'bg-warning text-warning-foreground hover:bg-warning/90';
    } elseif ($color === 'info') {
        $variantClasses['default'] = 'bg-info text-info-foreground hover:bg-info/90';
    } elseif ($color === 'error') {
        $variantClasses['default'] = 'bg-error text-error-foreground hover:bg-error/90';
    } elseif ($color === 'danger') {
        $variantClasses['default'] = 'bg-danger text-danger-foreground hover:bg-danger/90';
    }
    
    $classes = trim($baseClasses . ' ' . ($sizeClasses[$size] ?? $sizeClasses['default']) . ' ' . ($variantClasses[$variant] ?? $variantClasses['default']));
    
    // Auto-detect Livewire
    $wireClick = $attributes->get('wire:click');
    $wireSubmit = $attributes->get('wire:submit');
    $hasWireClick = $wireClick !== null || $wireSubmit !== null;
    
    // Get wire:target if specified, otherwise use wire:click or wire:submit value
    $wireTarget = $attributes->get('wire:target');
    if (!$wireTarget && $hasWireClick) {
        $wireTarget = $wireClick ?? $wireSubmit;
    }
    
    // Loading state logic
    $isLoading = false;
    $wireLoadingEnabled = false;
    
    if ($loading === true) {
        // Manual loading
        $isLoading = true;
    } elseif ($hasWireClick) {
        // Auto-enable wire:loading
        $wireLoadingEnabled = true;
    }
    
    // Loading text logic
    $displayText = $slot;
    if ($isLoading || $wireLoadingEnabled) {
        if ($loadingText !== null && $loadingText !== '') {
            // Show custom loading text
            $displayText = $loadingText;
        } else {
            // Show original text
            $displayText = $slot;
        }
    }
    
    // Build button attributes
    $buttonAttributes = $attributes->merge(['class' => $classes]);
    
    // Add wire:loading.attr directive if Livewire detected
    if ($wireLoadingEnabled) {
        $buttonAttributes = $buttonAttributes->merge([
            'wire:loading.attr' => 'disabled',
        ]);
    }
    
    // Disable button if manual loading
    if ($isLoading && !$wireLoadingEnabled) {
        $buttonAttributes = $buttonAttributes->merge(['disabled' => true]);
    }
    
    // Spinner SVG (reusable)
    $spinnerSvg = '<svg class="mr-2 h-4 w-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
@endphp

<button type="{{ $type }}" {{ $buttonAttributes->except(['loading', 'loadingText', 'showSpinner']) }}>
    @if($wireLoadingEnabled)
        {{-- Livewire loading state --}}
        <span wire:loading.remove @if($wireTarget) wire:target="{{ $wireTarget }}" @endif>
            {{ $slot }}
        </span>
        <span wire:loading @if($wireTarget) wire:target="{{ $wireTarget }}" @endif>
            @if($showSpinner)
                {!! $spinnerSvg !!}
            @endif
            {{ $displayText }}
        </span>
    @elseif($isLoading)
        {{-- Manual loading state --}}
        @if($showSpinner)
            {!! $spinnerSvg !!}
        @endif
        {{ $displayText }}
    @else
        {{-- Normal state --}}
        {{ $slot }}
    @endif
</button>

