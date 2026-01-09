{{-- radio-group.blade.php --}}
@props([
    'value' => null,
    'defaultValue' => null,
    'name' => 'radio-group-' . uniqid(),
    'id' => null,
    'disabled' => false,
    'required' => false,
    'size' => 'default',
    'options' => null,
    'label' => null,
    'help' => null,
    'errorMessage' => null,
])

@php
    $initialValue = $value ?? $defaultValue;
    
    // Generate ID if not provided
    $groupId = $id ?? ($name ? "radio-group-{$name}" : 'radio-group-' . uniqid());
    
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
                    // Array format: [['value' => 'yes', 'label' => 'Yes'], ...]
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
                    // Associative array: ['yes' => 'Yes', 'no' => 'No']
                    $processedOptions[] = [
                        'value' => $key,
                        'label' => $option,
                    ];
                }
            }
        }
    }
    
    // Build aria attributes
    $ariaAttributes = [];
    $describedBy = [];
    
    if ($hasError && $groupId) {
        $ariaAttributes['aria-invalid'] = 'true';
        $describedBy[] = "{$groupId}-error";
    }
    
    if ($help && $groupId) {
        $describedBy[] = "{$groupId}-help";
    }
    
    if ($required) {
        $ariaAttributes['aria-required'] = 'true';
    }
    
    if (!empty($describedBy)) {
        $ariaAttributes['aria-describedby'] = implode(' ', $describedBy);
    }
@endphp

<div class="w-full">
    @if($label && $groupId)
        <x-slate::label 
            :for="$groupId" 
            :required="$required" 
            :size="$size" 
            :error="$hasError"
            class="mb-1"
        >
            {{ $label }}
        </x-slate::label>
    @endif
    
    <div
        x-data="{
            value: @js($initialValue),
            name: '{{ $name }}',
            setValue(newValue) {
                if ({{ $disabled ? 'true' : 'false' }}) return;
                this.value = newValue;
                this.$dispatch('change', { value: this.value });
            }
        }"
        x-id="['radio-group']"
        id="{{ $groupId }}"
        role="radiogroup"
        @foreach($ariaAttributes as $attr => $val)
            {{ $attr }}="{{ $val }}"
        @endforeach
        {{ $attributes->except(['options', 'name', 'id', 'value', 'disabled', 'required', 'size', 'help', 'errorMessage', 'label', 'defaultValue'])->merge([
            'class' => 'grid gap-2'
        ]) }}
    >
        @if($processedOptions !== null)
            @foreach($processedOptions as $option)
                <x-slate::radio-group-item value="{{ $option['value'] }}" :disabled="$disabled">{{ $option['label'] }}</x-slate::radio-group-item>
            @endforeach
        @else
            {{ $slot }}
        @endif
    </div>
    
    @if($help && $groupId)
        <p id="{{ $groupId }}-help" class="mt-1 text-sm text-muted-foreground">
            {{ $help }}
        </p>
    @endif
    
    @if($hasError && $finalErrorMessage && $groupId)
        <p id="{{ $groupId }}-error" class="mt-1 text-sm text-danger">
            {{ $finalErrorMessage }}
        </p>
    @endif
</div>
