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
    // Base classes - checkbox styling
    // Uses: peer for styling the label, and standard checkbox with custom styling
    $baseClasses = 'h-4 w-4 shrink-0 rounded-sm border border-primary ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 transition-colors';
    
    // Size classes - checkbox size variants
    $sizeClasses = [
        'sm' => 'h-3.5 w-3.5',
        'default' => 'h-4 w-4',
        'lg' => 'h-5 w-5',
    ];
    
    // Get size classes
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['default'];
    
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
    
    // Build classes
    $classes = trim(implode(' ', array_filter([
        $baseClasses,
        $sizeClass,
        $errorClasses,
        'peer', // For label styling
        $attributes->get('class'),
    ])));
    
    // Generate ID if not provided
    $checkboxId = $id ?? ($name ? "checkbox-{$name}" : null);
    
    // Build aria attributes
    $ariaAttributes = [];
    $describedBy = [];
    
    if ($hasError && $checkboxId) {
        $ariaAttributes['aria-invalid'] = 'true';
        $describedBy[] = "{$checkboxId}-error";
    }
    
    if ($help && $checkboxId) {
        $describedBy[] = "{$checkboxId}-help";
    }
    
    if ($required) {
        $ariaAttributes['aria-required'] = 'true';
    }
    
    if (!empty($describedBy)) {
        $ariaAttributes['aria-describedby'] = implode(' ', $describedBy);
    }
    
    // Get checked state - Priority: explicit checked prop > old() helper > attributes
    $isChecked = $checked;
    if (!$isChecked && $name && function_exists('old')) {
        $oldValue = old($name);
        // For checkboxes, old() returns the value if checked, or null if not
        $isChecked = $oldValue !== null && $oldValue !== false && $oldValue !== '';
    }
    // Also check attributes for checked state
    if (!$isChecked && $attributes->has('checked')) {
        $isChecked = true;
    }
@endphp

<div class="flex flex-col items-start space-y-1">
    <div class="flex items-center space-x-2">
        <input
            type="checkbox"
            @if($name) name="{{ $name }}" @endif
            @if($checkboxId) id="{{ $checkboxId }}" @endif
            @if($value !== null) value="{{ $value }}" @endif
            @if($isChecked) checked @endif
            @if($disabled) disabled @endif
            @if($required) required @endif
            @foreach($ariaAttributes as $attr => $val)
                {{ $attr }}="{{ $val }}"
            @endforeach
            {{ $attributes->merge(['class' => $classes])->except(['name', 'id', 'value', 'checked', 'disabled', 'required', 'size', 'help', 'errorMessage', 'label']) }}
        />
        
        @if($label && $checkboxId)
            <x-slate::label 
                :for="$checkboxId" 
                :required="$required" 
                :size="$size" 
                :error="$hasError"
                class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 cursor-pointer"
            >
                {{ $label }}
            </x-slate::label>
        @endif
    </div>
    
    @if($help && $checkboxId)
        <p id="{{ $checkboxId }}-help" class="text-sm text-muted-foreground ml-6">
            {{ $help }}
        </p>
    @endif
    
    @if($hasError && $finalErrorMessage && $checkboxId)
        <p id="{{ $checkboxId }}-error" class="text-sm text-danger ml-6">
            {{ $finalErrorMessage }}
        </p>
    @endif
</div>

