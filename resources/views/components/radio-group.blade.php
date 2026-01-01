@props([
    'name' => null,
    'label' => null,
    'help' => null,
    'errorMessage' => null,
    'required' => false,
    'size' => 'default',
    'options' => [],
    'value' => null,
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
    
    // Generate group ID if not provided
    $groupId = $attributes->get('id') ?? ($name ? "radio-group-{$name}" : null);
    
    // Build aria attributes for the group
    $groupAriaAttributes = [];
    $describedBy = [];
    
    if ($hasError && $groupId) {
        $groupAriaAttributes['aria-invalid'] = 'true';
        $describedBy[] = "{$groupId}-error";
    }
    
    if ($help && $groupId) {
        $describedBy[] = "{$groupId}-help";
    }
    
    if ($required) {
        $groupAriaAttributes['aria-required'] = 'true';
    }
    
    if (!empty($describedBy)) {
        $groupAriaAttributes['aria-describedby'] = implode(' ', $describedBy);
    }
    
    // Get selected value - Priority: explicit value prop > old() helper > attributes
    $selectedValue = $value;
    if ($selectedValue === null && $name && function_exists('old') && !$isLivewire) {
        $selectedValue = old($name);
    }
    // Also check attributes for value
    if ($selectedValue === null && !$isLivewire) {
        $selectedValue = $attributes->get('value');
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

<div class="flex flex-col space-y-2" 
     @if($groupId) id="{{ $groupId }}" @endif
     @foreach($groupAriaAttributes as $attr => $val)
         {{ $attr }}="{{ $val }}"
     @endforeach
     role="radiogroup"
>
    @if($label)
        <x-slate::label 
            :required="$required" 
            :size="$size" 
            :error="$hasError"
            class="mb-2"
        >
            {{ $label }}
        </x-slate::label>
    @endif
    
    <div class="space-y-2">
        @foreach($normalizedOptions as $optionValue => $optionLabel)
            @php
                // Generate unique ID for each radio
                $radioId = $groupId ? "{$groupId}-{$optionValue}" : ($name ? "{$name}-{$optionValue}" : null);
                
                // Check if this option is selected
                $isChecked = false;
                if (!$isLivewire) {
                    $isChecked = $selectedValue !== null && (string)$selectedValue === (string)$optionValue;
                }
            @endphp
            
            <div class="flex items-center space-x-2">
                @php
                    // Build radio classes with error state
                    $radioErrorClasses = $hasError ? 'border-danger focus-visible:ring-danger' : 'border-primary';
                    $radioClasses = "h-4 w-4 shrink-0 rounded-full border {$radioErrorClasses} ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 transition-colors peer";
                @endphp
                <input
                    type="radio"
                    @if($name) name="{{ $name }}" @endif
                    @if($radioId) id="{{ $radioId }}" @endif
                    value="{{ $optionValue }}"
                    @if($isChecked) checked @endif
                    @if($hasError) aria-invalid="true" @endif
                    class="{{ $radioClasses }}"
                    {{ $attributes->except(['id', 'name', 'value', 'options', 'label', 'help', 'errorMessage', 'required', 'size']) }}
                />
                
                <x-slate::label 
                    :for="$radioId" 
                    :size="$size" 
                    :error="$hasError"
                    class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 cursor-pointer"
                >
                    {{ $optionLabel }}
                </x-slate::label>
            </div>
        @endforeach
    </div>
    
    @if($help && $groupId)
        <p id="{{ $groupId }}-help" class="text-sm text-muted-foreground">
            {{ $help }}
        </p>
    @endif
    
    @if($hasError && $finalErrorMessage && $groupId)
        <p id="{{ $groupId }}-error" class="text-sm text-danger">
            {{ $finalErrorMessage }}
        </p>
    @endif
</div>

