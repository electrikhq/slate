@props([
    'name' => null,
    'label' => null,
    'help' => null,
    'errorMessage' => null,
    'required' => false,
    'size' => 'default',
    'id' => null,
    'for' => null, // ID of the input field to link label to
])

@php
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
    
    // Generate container ID if not provided
    // Priority: explicit id > name > wire:model property > null
    $fieldId = $id ?? ($name ? "field-{$name}" : ($livewireProperty ? "field-{$livewireProperty}" : null));
    
    // Generate input ID for label linking (if not provided, try to infer from name or wire:model)
    $inputId = $for ?? ($name ? "input-{$name}" : ($livewireProperty ? "input-{$livewireProperty}" : null));
    
    // Build aria attributes
    $ariaAttributes = [];
    $describedBy = [];
    
    if ($hasError && $fieldId) {
        $ariaAttributes['aria-invalid'] = 'true';
        $describedBy[] = "{$fieldId}-error";
    }
    
    if ($help && $fieldId) {
        $describedBy[] = "{$fieldId}-help";
    }
    
    if ($required) {
        $ariaAttributes['aria-required'] = 'true';
    }
    
    if (!empty($describedBy)) {
        $ariaAttributes['aria-describedby'] = implode(' ', $describedBy);
    }
@endphp

<div 
    class="w-full space-y-1"
    @if($fieldId) id="{{ $fieldId }}" @endif
    @foreach($ariaAttributes as $attr => $val)
        {{ $attr }}="{{ $val }}"
    @endforeach
    {{ $attributes->merge(['class' => 'w-full space-y-1'])->except(['name', 'id', 'label', 'help', 'errorMessage', 'required', 'size', 'for']) }}
>
    @if($label && $inputId)
        <x-slate::label 
            :for="$inputId" 
            :required="$required" 
            :size="$size" 
            :error="$hasError"
        >
            {{ $label }}
        </x-slate::label>
    @endif
    
    {{-- Slot for form field --}}
    <div>
        {{ $slot }}
    </div>
    
    @if($help && $fieldId)
        <p id="{{ $fieldId }}-help" class="text-sm text-muted-foreground">
            {{ $help }}
        </p>
    @endif
    
    @if($hasError && $finalErrorMessage && $fieldId)
        <p id="{{ $fieldId }}-error" class="text-sm text-danger">
            {{ $finalErrorMessage }}
        </p>
    @endif
</div>

