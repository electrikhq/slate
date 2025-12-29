@props([
    'size' => 'default',
    'disabled' => false,
    'required' => false,
    'autofocus' => false,
    'placeholder' => null,
    'name' => null,
    'id' => null,
    'options' => [],
    'value' => null,
    'help' => null,
    'errorMessage' => null,
    'label' => null,
])

@php
    // Base classes - matching shadcn/ui exactly (same as Input)
    $baseClasses = 'flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 transition-colors';
    
    // Size classes - matching shadcn/ui exactly (same as Input)
    $sizeClasses = [
        'sm' => 'h-9 px-2.5 text-sm',
        'default' => 'h-10 px-3 py-2 text-sm',
        'lg' => 'h-11 px-4 text-sm',
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
        $attributes->get('class'),
    ])));
    
    // Generate ID if not provided
    $selectId = $id ?? ($name ? "select-{$name}" : null);
    
    // Build aria attributes
    $ariaAttributes = [];
    $describedBy = [];
    
    if ($hasError && $selectId) {
        $ariaAttributes['aria-invalid'] = 'true';
        $describedBy[] = "{$selectId}-error";
    }
    
    if ($help && $selectId) {
        $describedBy[] = "{$selectId}-help";
    }
    
    if ($required) {
        $ariaAttributes['aria-required'] = 'true';
    }
    
    if (!empty($describedBy)) {
        $ariaAttributes['aria-describedby'] = implode(' ', $describedBy);
    }
    
    // Get selected value from attributes, old() helper, or prop
    // Priority: explicit value prop > attributes value > old() helper
    // When using Livewire, don't set static selected value - let Livewire handle it
    $selectedValue = null;
    if (!$isLivewire) {
        $selectedValue = $value ?? $attributes->get('value');
        if ($selectedValue === null && $name && function_exists('old')) {
            $selectedValue = old($name);
        }
    }
    
    // Normalize options - handle both array formats
    // ['value' => 'label'] or ['value1', 'value2'] or [['value' => 'val', 'label' => 'Label']]
    $normalizedOptions = [];
    foreach ($options as $key => $option) {
        if (is_array($option) && isset($option['value']) && isset($option['label'])) {
            // Format: [['value' => 'val', 'label' => 'Label']]
            $normalizedOptions[$option['value']] = $option['label'];
        } elseif (is_numeric($key) && is_string($option)) {
            // Format: ['value1', 'value2'] - use value as label
            $normalizedOptions[$option] = $option;
        } else {
            // Format: ['value' => 'label']
            $normalizedOptions[$key] = $option;
        }
    }
@endphp

<div class="w-full">
    @if($label && $selectId)
        <x-slate::label 
            :for="$selectId" 
            :required="$required" 
            :size="$size" 
            :error="$hasError"
            class="mb-1"
        >
            {{ $label }}
        </x-slate::label>
    @endif
    
    <select
        @if($name) name="{{ $name }}" @endif
        @if($selectId) id="{{ $selectId }}" @endif
        @if($disabled) disabled @endif
        @if($required) required @endif
        @if($autofocus) autofocus @endif
        @foreach($ariaAttributes as $attr => $val)
            {{ $attr }}="{{ $val }}"
        @endforeach
        {{ $attributes->merge(['class' => $classes])->except(['name', 'id', 'disabled', 'readonly', 'required', 'autofocus', 'size', 'help', 'errorMessage', 'label', 'options', 'value', 'placeholder']) }}
    >
        @if($placeholder)
            <option value="" disabled @if($selectedValue === null || $selectedValue === '') selected @endif>
                {{ $placeholder }}
            </option>
        @endif
        
        @foreach($normalizedOptions as $optionValue => $optionLabel)
            <option 
                value="{{ $optionValue }}"
                @if($selectedValue !== null && (string)$selectedValue === (string)$optionValue) selected @endif
            >
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>
    
    @if($help && $selectId)
        <p id="{{ $selectId }}-help" class="mt-1 text-sm text-muted-foreground">
            {{ $help }}
        </p>
    @endif
    
    @if($hasError && $finalErrorMessage && $selectId)
        <p id="{{ $selectId }}-error" class="mt-1 text-sm text-danger">
            {{ $finalErrorMessage }}
        </p>
    @endif
</div>

