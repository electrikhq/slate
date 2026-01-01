@props([
    'size' => 'default',
    'disabled' => false,
    'required' => false,
    'checked' => false,
    'name' => null,
    'id' => null,
    'value' => '1',
    'help' => null,
    'errorMessage' => null,
    'label' => null,
])

@php
    // Base classes for the switch track (the background)
    // Switch uses a hidden checkbox with peer classes, and a styled div for the visual switch
    // Uses ::after pseudo-element for the thumb (circle that moves)
    // Reduced focus ring to 2px and made it lighter for a softer appearance
    $trackBaseClasses = 'relative shrink-0 cursor-pointer rounded-full transition-colors peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-ring/20';
    
    // Track size classes
    $trackSizeClasses = [
        'sm' => 'h-5 w-9',
        'default' => 'h-6 w-11',
        'lg' => 'h-7 w-12',
    ];
    
    // After pseudo-element (thumb) size classes
    $afterSizeClasses = [
        'sm' => 'after:h-4 after:w-4 after:top-[2px] after:left-[2px]',
        'default' => 'after:h-5 after:w-5 after:top-[2px] after:left-[2px]',
        'lg' => 'after:h-6 after:w-6 after:top-[2px] after:left-[2px]',
    ];
    
    // Get size classes
    $trackSizeClass = $trackSizeClasses[$size] ?? $trackSizeClasses['default'];
    $afterSizeClass = $afterSizeClasses[$size] ?? $afterSizeClasses['default'];
    
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
    
    // Add error classes if validation failed
    $errorClasses = $hasError ? 'border-danger focus-visible:ring-danger' : '';
    
    // Build track classes - don't include size class here, it's added separately
    $trackClasses = trim(implode(' ', array_filter([
        $trackBaseClasses,
        $errorClasses,
        $attributes->get('class'),
    ])));
    
    // Generate ID if not provided
    $switchId = $id ?? ($name ? "switch-{$name}" : null);
    
    // Build aria attributes
    $ariaAttributes = [];
    $describedBy = [];
    
    if ($hasError && $switchId) {
        $ariaAttributes['aria-invalid'] = 'true';
        $describedBy[] = "{$switchId}-error";
    }
    
    if ($help && $switchId) {
        $describedBy[] = "{$switchId}-help";
    }
    
    if ($required) {
        $ariaAttributes['aria-required'] = 'true';
    }
    
    if (!empty($describedBy)) {
        $ariaAttributes['aria-describedby'] = implode(' ', $describedBy);
    }
    
    // Get checked state - Priority: explicit checked prop > old() helper > attributes
    $isChecked = $checked;
    if (!$isChecked && $name && function_exists('old') && !$isLivewire) {
        $oldValue = old($name);
        // For switches, old() returns the value if checked, or null if not
        $isChecked = $oldValue !== null && $oldValue !== false && $oldValue !== '';
    }
    // Also check attributes for checked state
    if (!$isChecked && $attributes->has('checked')) {
        $isChecked = true;
    }
@endphp

<div class="flex flex-col items-start space-y-1">
    <div class="flex items-center space-x-2">
        <label class="relative inline-flex items-center cursor-pointer">
            <input
                type="checkbox"
                @if($name) name="{{ $name }}" @endif
                @if($switchId) id="{{ $switchId }}" @endif
                @if($value !== null) value="{{ $value }}" @endif
                @if($isChecked) checked @endif
                @if($disabled) disabled @endif
                @if($required) required @endif
                @foreach($ariaAttributes as $attr => $val)
                    {{ $attr }}="{{ $val }}"
                @endforeach
                class="sr-only peer"
                {{ $attributes->except(['name', 'id', 'value', 'checked', 'disabled', 'required', 'size', 'help', 'errorMessage', 'label', 'class']) }}
            />
            <div class="{{ $trackClasses }} {{ $trackSizeClass }}
    bg-muted
    peer-checked:bg-primary
    peer-disabled:cursor-not-allowed
    peer-disabled:opacity-50

    after:content-['']
    after:absolute
    {{ $afterSizeClass }}
    after:rounded-full
    after:transition-all
    after:shadow-md
    after:bg-white
    dark:after:bg-background

    peer-checked:after:translate-x-full
    rtl:peer-checked:after:-translate-x-full"></div>
            @if($label)
                <span class="ml-2 font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 cursor-pointer {{ $size === 'sm' ? 'text-xs' : ($size === 'lg' ? 'text-base' : 'text-sm') }} {{ $hasError ? 'text-danger' : 'text-foreground' }} {{ $required ? 'after:content-["*"] after:ml-0.5 after:text-danger' : '' }}">
                    {{ $label }}
                </span>
            @endif
        </label>
    </div>
    
    @if($help && $switchId)
        <p id="{{ $switchId }}-help" class="text-sm text-muted-foreground ml-6">
            {{ $help }}
        </p>
    @endif
    
    @if($hasError && $finalErrorMessage && $switchId)
        <p id="{{ $switchId }}-error" class="text-sm text-danger ml-6">
            {{ $finalErrorMessage }}
        </p>
    @endif
</div>

