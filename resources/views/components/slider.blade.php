@props([
    'size' => 'default',
    'disabled' => false,
    'required' => false,
    'name' => null,
    'id' => null,
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'value' => null,
    'help' => null,
    'errorMessage' => null,
    'label' => null,
])

@php
    // Base classes for range input (slider)
    // Range inputs need custom styling with webkit and moz prefixes
    // Track uses muted background, thumb uses accent-color
    $baseClasses = 'range-slider w-full appearance-none bg-transparent disabled:cursor-not-allowed disabled:opacity-50';
    
    // Size classes - slider height variants
    $sizeClasses = [
        'sm' => 'h-1.5',
        'default' => 'h-2',
        'lg' => 'h-2.5',
    ];
    
    // Get size classes
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['default'];
    
    // Track height for CSS variables (matches Tailwind sizes)
    $trackHeights = [
        'sm' => '0.375rem',    // h-1.5 = 6px
        'default' => '0.5rem', // h-2 = 8px
        'lg' => '0.625rem',    // h-2.5 = 10px
    ];
    $trackHeight = $trackHeights[$size] ?? $trackHeights['default'];
    
    // Auto-detect Livewire
    $isLivewire = $attributes->has('wire:model') || 
                  $attributes->has('wire:model.live') ||
                  $attributes->has('wire:model.defer') ||
                  $attributes->has('wire:model.blur');
    
    // Get Livewire model property name for error detection
    $livewireProperty = null;
    if ($isLivewire) {
        $livewireProperty = $attributes->get('wire:model') ?? 
                           $attributes->get('wire:model.live') ?? 
                           $attributes->get('wire:model.defer') ??
                           $attributes->get('wire:model.blur');
        // Remove quotes if present
        $livewireProperty = trim($livewireProperty, '\'"');
    }
    
    // Auto-detect Laravel form
    $isLaravelForm = $name !== null;
    
    // Handle validation errors - Priority: manual override > automatic detection
    $hasError = false;
    $finalErrorMessage = null;
    
    // Priority 1: Manual error override
    if ($errorMessage !== null) {
        $hasError = true;
        $finalErrorMessage = $errorMessage;
    }
    // Priority 2: Auto-detect from Laravel/Livewire errors bag
    elseif ($isLivewire || $isLaravelForm) {
        $errors = $errors ?? (function_exists('view') && view()->shared('errors') ? view()->shared('errors') : null);
        if ($errors) {
            // For Livewire, check both the wire:model property name and the name attribute
            $errorKey = $isLivewire && $livewireProperty ? $livewireProperty : $name;
            if ($errorKey && $errors->has($errorKey)) {
                $hasError = true;
                $finalErrorMessage = $errors->first($errorKey);
            }
        }
    }
    
    // Add accent color - primary by default, danger on error
    $accentColor = $hasError ? 'accent-danger' : 'accent-primary';
    
    // Add error classes if validation failed
    $errorClasses = $hasError ? 'focus-visible:ring-danger' : '';
    
    // Track color - muted by default, danger on error
    $trackColor = $hasError ? 'hsl(var(--color-danger))' : 'hsl(var(--color-muted))';
    
    // Build classes
    $classes = trim(implode(' ', array_filter([
        $baseClasses,
        $accentColor,
        $sizeClass,
        $errorClasses,
        $attributes->get('class'),
    ])));
    
    // Build inline style for CSS variables (dynamic values)
    $inlineStyle = "style=\"--slider-track-height: {$trackHeight}; --slider-track-color: {$trackColor};\"";
    
    // Generate ID if not provided
    $sliderId = $id ?? ($name ? "slider-{$name}" : null);
    
    // Build aria attributes
    $ariaAttributes = [];
    $describedBy = [];
    
    if ($hasError && $sliderId) {
        $ariaAttributes['aria-invalid'] = 'true';
        $describedBy[] = "{$sliderId}-error";
    }
    
    if ($help && $sliderId) {
        $describedBy[] = "{$sliderId}-help";
    }
    
    if ($required) {
        $ariaAttributes['aria-required'] = 'true';
    }
    
    // Add aria-valuemin, aria-valuemax, aria-valuenow for accessibility
    $ariaAttributes['aria-valuemin'] = $min;
    $ariaAttributes['aria-valuemax'] = $max;
    
    if (!empty($describedBy)) {
        $ariaAttributes['aria-describedby'] = implode(' ', $describedBy);
    }
    
    // Get value - Priority: explicit value prop > old() helper > attributes
    $sliderValue = $value;
    if ($sliderValue === null && $name && function_exists('old') && !$isLivewire) {
        $sliderValue = old($name);
    }
    // Also check attributes for value
    if ($sliderValue === null && !$isLivewire) {
        $sliderValue = $attributes->get('value');
    }
    // Default to min if no value provided
    if ($sliderValue === null) {
        $sliderValue = $min;
    }
    
    // Ensure value is within min/max bounds
    $sliderValue = max($min, min($max, (int)$sliderValue));
    
    // Set aria-valuenow
    $ariaAttributes['aria-valuenow'] = $sliderValue;
@endphp

<div class="w-full">
    @if($label && $sliderId)
        <x-slate::label 
            :for="$sliderId" 
            :required="$required" 
            :size="$size" 
            :error="$hasError"
            class="mb-1"
        >
            {{ $label }}
        </x-slate::label>
    @endif
    
    <input
        type="range"
        @if($name) name="{{ $name }}" @endif
        @if($sliderId) id="{{ $sliderId }}" @endif
        min="{{ $min }}"
        max="{{ $max }}"
        step="{{ $step }}"
        @if(!$isLivewire && $sliderValue !== null) value="{{ $sliderValue }}" @endif
        @if($disabled) disabled @endif
        @if($required) required @endif
        {!! $inlineStyle !!}
        @foreach($ariaAttributes as $attr => $val)
            {{ $attr }}="{{ $val }}"
        @endforeach
        {{ $attributes->merge(['class' => $classes])->except(['name', 'id', 'value', 'min', 'max', 'step', 'disabled', 'required', 'size', 'help', 'errorMessage', 'label']) }}
    />
    
    @if($help && $sliderId)
        <p id="{{ $sliderId }}-help" class="mt-1 text-sm text-muted-foreground">
            {{ $help }}
        </p>
    @endif
    
    @if($hasError && $finalErrorMessage && $sliderId)
        <p id="{{ $sliderId }}-error" class="mt-1 text-sm text-danger">
            {{ $finalErrorMessage }}
        </p>
    @endif
</div>

