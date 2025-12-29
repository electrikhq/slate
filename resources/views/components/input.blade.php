@props([
    'type' => 'text',
    'size' => 'default',
    'disabled' => false,
    'readonly' => false,
    'required' => false,
    'autofocus' => false,
    'placeholder' => null,
    'value' => null,
    'name' => null,
    'id' => null,
    'help' => null,
    'errorMessage' => null,
    'label' => null,
])

@php
    // Base classes
    $baseClasses = 'flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 transition-colors';
    
    // Size classes
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
    $inputId = $id ?? ($name ? "input-{$name}" : null);
    
    // Build aria attributes
    $ariaAttributes = [];
    $describedBy = [];
    
    if ($hasError && $inputId) {
        $ariaAttributes['aria-invalid'] = 'true';
        $describedBy[] = "{$inputId}-error";
    }
    
    if ($help && $inputId) {
        $describedBy[] = "{$inputId}-help";
    }
    
    if ($required) {
        $ariaAttributes['aria-required'] = 'true';
    }
    
    if (!empty($describedBy)) {
        $ariaAttributes['aria-describedby'] = implode(' ', $describedBy);
    }
@endphp

<div class="w-full">
    @if($label && $inputId)
        <x-slate::label 
            :for="$inputId" 
            :required="$required" 
            :size="$size" 
            :error="$hasError"
            class="mb-1"
        >
            {{ $label }}
        </x-slate::label>
    @endif
    
    <input
        type="{{ $type }}"
        @if($name) name="{{ $name }}" @endif
        @if($inputId) id="{{ $inputId }}" @endif
        @if(!$isLivewire && $value !== null) value="{{ $value }}" @endif
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        @if($disabled) disabled @endif
        @if($readonly) readonly @endif
        @if($required) required @endif
        @if($autofocus) autofocus @endif
        @foreach($ariaAttributes as $attr => $val)
            {{ $attr }}="{{ $val }}"
        @endforeach
        {{ $attributes->merge(['class' => $classes])->except(['name', 'id', 'value', 'placeholder', 'disabled', 'readonly', 'required', 'autofocus', 'type', 'size', 'help', 'errorMessage', 'label']) }}
    />
    
    @if($help && $inputId)
        <p id="{{ $inputId }}-help" class="mt-1 text-sm text-muted-foreground">
            {{ $help }}
        </p>
    @endif
    
    @if($hasError && $finalErrorMessage && $inputId)
        <p id="{{ $inputId }}-error" class="mt-1 text-sm text-danger">
            {{ $finalErrorMessage }}
        </p>
    @endif
</div>

