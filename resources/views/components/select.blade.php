{{-- select.blade.php --}}
@props([
    'value' => null,
    'defaultValue' => null,
    'name' => null,
    'disabled' => false,
    'required' => false,
    'size' => 'default',
    'id' => null,
    'options' => null,
    'placeholder' => 'Select an option...',
    'label' => null,
    'help' => null,
    'errorMessage' => null,
])

@php
    $initialValue = $value ?? $defaultValue;
    
    // Generate ID if not provided
    $selectId = $id ?? ($name ? "select-{$name}" : 'select-' . uniqid());
    
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
    // Priority 2: Laravel validation errors (if name provided)
    elseif ($isLaravelForm && $name && isset($errors) && $errors->has($name)) {
        $hasError = true;
        $finalErrorMessage = $errors->first($name);
    }
    // Priority 3: Livewire validation errors
    elseif ($isLivewire && $livewireProperty && isset($errors) && $errors->has($livewireProperty)) {
        $hasError = true;
        $finalErrorMessage = $errors->first($livewireProperty);
    }
    
    // Process options if provided
    $processedOptions = null;
    if ($options !== null) {
        if (is_array($options)) {
            $processedOptions = [];
            foreach ($options as $key => $option) {
                if (is_array($option)) {
                    // Array format: [['value' => 'us', 'label' => 'United States'], ...]
                    $processedOptions[] = [
                        'value' => $option['value'] ?? $option[0] ?? null,
                        'label' => $option['label'] ?? $option[1] ?? $option[0] ?? '',
                    ];
                } elseif (is_numeric($key)) {
                    // Indexed array: ['Red', 'Green', 'Blue']
                    $processedOptions[] = [
                        'value' => $option,
                        'label' => $option,
                    ];
                } else {
                    // Associative array: ['us' => 'United States', 'ca' => 'Canada']
                    $processedOptions[] = [
                        'value' => $key,
                        'label' => $option,
                    ];
                }
            }
        }
    }
    
    // Size classes
    $sizeClasses = [
        'sm' => 'h-9 px-2.5 text-sm',
        'default' => 'h-10 px-3 py-2 text-sm',
        'lg' => 'h-11 px-4 text-sm',
    ];
    
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['default'];
    
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
    
    // Build class string
    $selectClasses = "flex w-full rounded-md border bg-background {$sizeClass} ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 transition-colors appearance-none pr-8";
    
    if ($hasError) {
        $selectClasses .= ' border-danger focus-visible:ring-danger';
    } else {
        $selectClasses .= ' border-input';
    }
    
    // Arrow SVG as data URL (properly encoded)
    $arrowSvg = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23999999' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E";
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
        id="{{ $selectId }}"
        name="{{ $name }}"
        @if($disabled) disabled @endif
        @if($required) required @endif
        @foreach($ariaAttributes as $attr => $val)
            {{ $attr }}="{{ $val }}"
        @endforeach
        class="{{ $selectClasses }}"
        style="background-image: url('{{ $arrowSvg }}'); background-size: 16px 16px; background-position: right 0.75rem center; background-repeat: no-repeat;"
        {{ $attributes->except(['options', 'name', 'id', 'value', 'placeholder', 'disabled', 'required', 'size', 'help', 'errorMessage', 'label', 'defaultValue'])->merge(['value' => $initialValue]) }}
    >
        @if($placeholder && !$initialValue)
            <option value="" disabled selected>{{ $placeholder }}</option>
        @endif
        
        @if($processedOptions !== null)
            @foreach($processedOptions as $option)
                <option 
                    value="{{ $option['value'] }}"
                    @if($initialValue !== null && (string)$initialValue === (string)$option['value']) selected @endif
                >
                    {{ $option['label'] }}
                </option>
            @endforeach
        @else
            {{ $slot }}
        @endif
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
