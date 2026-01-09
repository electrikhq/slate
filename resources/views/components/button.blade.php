@props([
    'variant' => 'default',
    'size' => 'default',
    'color' => null,
    'type' => 'button',
    'loading' => false,
    'loadingText' => null,
    'showSpinner' => true,
    'icon' => null,
    'iconPosition' => 'left',
])

@php
    // Convert string booleans to actual booleans (Blade passes strings)
    $loading = filter_var($loading, FILTER_VALIDATE_BOOLEAN);
    $showSpinner = filter_var($showSpinner, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? true;
    
    // Icon sizing based on button size
    $iconSizeClasses = [
        'sm' => 'h-3 w-3',
        'default' => 'h-4 w-4',
        'lg' => 'h-5 w-5',
    ];
    $iconSize = $iconSizeClasses[$size] ?? $iconSizeClasses['default'];
    
    // Check if slot is empty (for icon-only detection)
    $slotContent = trim($slot->toHtml());
    $isIconOnly = !empty($icon) && empty($slotContent);
    
    // Adjust padding for icon-only buttons
    $sizeClasses = [
        'sm' => $isIconOnly ? 'h-8 w-8 p-0' : 'h-8 px-2.5',
        'default' => $isIconOnly ? 'h-9 w-9 p-0' : 'h-9 px-3',
        'lg' => $isIconOnly ? 'h-10 w-10 p-0' : 'h-10 px-4',
    ];
    
    $baseClasses = 'inline-flex items-center justify-center rounded-md text-sm leading-5 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none';
    
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
        'subtle' => 'hover:text-accent-foreground',
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
    
    // Check if button has href (for link buttons)
    $hasHref = $attributes->has('href');
    $cursorClass = $hasHref ? 'cursor-pointer' : '';
    
    $classes = trim($baseClasses . ' ' . ($sizeClasses[$size] ?? $sizeClasses['default']) . ' ' . ($variantClasses[$variant] ?? $variantClasses['default']) . ' ' . $cursorClass);
    
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
    
    // WCAG compliance: aria-busy and aria-disabled for loading states
    $isInLoadingState = $isLoading || $wireLoadingEnabled;
    $isDisabled = $attributes->has('disabled') || $isInLoadingState;
    
    // Add aria-busy when loading (WCAG 2.1 AA compliance)
    if ($isInLoadingState) {
        $buttonAttributes = $buttonAttributes->merge([
            'aria-busy' => 'true',
        ]);
    }
    
    // Add aria-disabled when disabled or loading (WCAG 2.1 AA compliance)
    if ($isDisabled) {
        $buttonAttributes = $buttonAttributes->merge([
            'aria-disabled' => 'true',
        ]);
    }
    
    // WCAG compliance: Auto-add aria-label for icon-only buttons if not provided
    if ($isIconOnly && !$buttonAttributes->has('aria-label')) {
        // Generate a readable label from icon name
        // e.g., "carbon-settings" -> "Settings", "carbon-trash-can" -> "Trash Can"
        $iconName = $icon;
        if (str_starts_with($iconName, 'carbon-')) {
            $iconName = substr($iconName, 7); // Remove "carbon-" prefix
        }
        // Convert kebab-case to Title Case
        $label = ucwords(str_replace(['-', '_'], ' ', $iconName));
        $buttonAttributes = $buttonAttributes->merge([
            'aria-label' => $label,
        ]);
    }
    
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
    
    // Icon classes helper
    $getIconClasses = function($position) use ($iconSize, $isIconOnly) {
        $spacingClass = $isIconOnly ? '' : ($position === 'left' ? 'mr-2' : 'ml-2');
        return trim("{$iconSize} {$spacingClass}");
    };
    
    // Icon rendering helper using Blade Icons svg() function
    $renderIcon = function($iconName, $position) use ($getIconClasses) {
        if (empty($iconName)) {
            return '';
        }
        $classes = $getIconClasses($position);
        // Use svg() helper function from Blade Icons
        if (function_exists('svg')) {
            try {
                return svg($iconName, $classes)->toHtml();
            } catch (\Exception $e) {
                // Gracefully handle icon rendering failures (e.g., in tests)
                // Return empty string so component still renders
                return '';
            }
        }
        // Fallback if Blade Icons not available
        return '';
    };
@endphp

<button type="{{ $type }}" {{ $buttonAttributes->except(['loading', 'loadingText', 'showSpinner', 'icon', 'iconPosition']) }}>
    @if($wireLoadingEnabled)
        {{-- Livewire loading state --}}
        <span wire:loading.remove @if($wireTarget) wire:target="{{ $wireTarget }}" @endif>
            @if($icon && $iconPosition === 'left')
                {!! $renderIcon($icon, 'left') !!}
            @endif
            {{ $slot }}
            @if($icon && $iconPosition === 'right')
                {!! $renderIcon($icon, 'right') !!}
            @endif
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
        @if($icon && $iconPosition === 'left')
            {!! $renderIcon($icon, 'left') !!}
        @endif
    {{ $slot }}
        @if($icon && $iconPosition === 'right')
            {!! $renderIcon($icon, 'right') !!}
        @endif
    @endif
</button>

