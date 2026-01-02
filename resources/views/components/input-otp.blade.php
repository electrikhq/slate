@props([
    'length' => 6,
    'size' => 'default',
    'disabled' => false,
    'readonly' => false,
    'required' => false,
    'autofocus' => false,
    'name' => null,
    'id' => null,
    'help' => null,
    'errorMessage' => null,
    'label' => null,
    'type' => 'text', // 'text' or 'password' (for masked OTP)
])

@php
    // Base classes for each input field
    $baseClasses = 'flex h-10 w-10 rounded-md border border-input bg-background text-center text-sm ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50';
    
    // Size classes
    $sizeClasses = [
        'sm' => 'h-9 w-9 text-sm',
        'default' => 'h-10 w-10 text-sm',
        'lg' => 'h-11 w-11 text-base',
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
    
    // Build classes for each input
    $inputClasses = trim(implode(' ', array_filter([
        $baseClasses,
        $sizeClass,
        $errorClasses,
    ])));
    
    // Generate container ID if not provided
    $containerId = $id ?? ($name ? "input-otp-{$name}" : "input-otp-" . uniqid());
    
    // Generate hidden input ID for form submission
    $hiddenInputId = "{$containerId}-value";
    
    // Build aria attributes for container
    $ariaAttributes = [];
    $describedBy = [];
    
    if ($hasError && $containerId) {
        $ariaAttributes['aria-invalid'] = 'true';
        $describedBy[] = "{$containerId}-error";
    }
    
    if ($help && $containerId) {
        $describedBy[] = "{$containerId}-help";
    }
    
    if ($required) {
        $ariaAttributes['aria-required'] = 'true';
    }
    
    if (!empty($describedBy)) {
        $ariaAttributes['aria-describedby'] = implode(' ', $describedBy);
    }
    
    // Get current value for initialization
    $currentValue = '';
    if ($isLivewire && $livewireProperty && function_exists('livewire')) {
        // Try to get value from Livewire component
        try {
            $component = livewire()->current();
            if ($component && property_exists($component, $livewireProperty)) {
                $currentValue = $component->{$livewireProperty} ?? '';
            }
        } catch (\Exception $e) {
            // Ignore errors
        }
    } elseif ($name && function_exists('old')) {
        $currentValue = old($name, '');
    }
    
    // Ensure length is between 1 and 10
    $length = max(1, min(10, (int) $length));
@endphp

<div 
    class="w-full"
    x-data="{
        length: {{ $length }},
        values: Array({{ $length }}).fill(''),
        focusedIndex: {{ $autofocus ? 0 : -1 }},
        containerId: '{{ $containerId }}',
        hiddenInputId: '{{ $hiddenInputId }}',
        @if($isLivewire && $livewireProperty)
        wireProperty: '{{ $livewireProperty }}',
        @endif
        
        init() {
            // Initialize values from current value
            @if($currentValue)
            const initialValue = '{{ $currentValue }}';
            if (initialValue) {
                this.setValue(initialValue);
            }
            @endif
            
            // Focus first input if autofocus
            @if($autofocus)
            this.$nextTick(() => {
                this.focusInput(0);
            });
            @endif
        },
        
        getValue() {
            return this.values.join('');
        },
        
        setValue(value) {
            const chars = value.toString().split('').slice(0, this.length);
            this.values = Array(this.length).fill('').map((_, i) => chars[i] || '');
            this.updateHiddenInput();
            @if($isLivewire && $livewireProperty)
            @if($attributes->has('wire:model.live'))
            $wire.set(this.wireProperty, this.getValue());
            @elseif($attributes->has('wire:model.blur'))
            // Will update on blur
            @elseif($attributes->has('wire:model.defer'))
            // Will update on next request
            @else
            $wire.set(this.wireProperty, this.getValue());
            @endif
            @endif
        },
        
        updateHiddenInput() {
            const hiddenInput = document.getElementById(this.hiddenInputId);
            if (hiddenInput) {
                hiddenInput.value = this.getValue();
            }
        },
        
        focusInput(index) {
            if (index >= 0 && index < this.length) {
                const input = document.getElementById(`${this.containerId}-${index}`);
                if (input) {
                    input.focus();
                    input.select();
                    this.focusedIndex = index;
                }
            }
        },
        
        handleInput(index, event) {
            const value = event.target.value;
            
            // Only allow single character
            if (value.length > 1) {
                // Handle paste
                this.handlePaste(value);
                return;
            }
            
            // Update value
            this.values[index] = value;
            this.updateHiddenInput();
            
            // Move to next input if value entered
            if (value && index < this.length - 1) {
                this.focusInput(index + 1);
            }
            
            @if($isLivewire && $livewireProperty)
            @if($attributes->has('wire:model.live'))
            $wire.set(this.wireProperty, this.getValue());
            @elseif($attributes->has('wire:model.blur'))
            // Will update on blur
            @elseif($attributes->has('wire:model.defer'))
            // Will update on next request
            @else
            $wire.set(this.wireProperty, this.getValue());
            @endif
            @endif
        },
        
        handleKeydown(index, event) {
            // Handle backspace
            if (event.key === 'Backspace') {
                if (this.values[index]) {
                    // Clear current input
                    this.values[index] = '';
                    this.updateHiddenInput();
                    @if($isLivewire && $livewireProperty)
                    @if($attributes->has('wire:model.live'))
                    $wire.set(this.wireProperty, this.getValue());
                    @endif
                    @endif
                } else if (index > 0) {
                    // Move to previous input and clear it
                    this.values[index - 1] = '';
                    this.updateHiddenInput();
                    this.focusInput(index - 1);
                    @if($isLivewire && $livewireProperty)
                    @if($attributes->has('wire:model.live'))
                    $wire.set(this.wireProperty, this.getValue());
                    @endif
                    @endif
                }
                event.preventDefault();
                return;
            }
            
            // Handle arrow keys
            if (event.key === 'ArrowLeft' && index > 0) {
                event.preventDefault();
                this.focusInput(index - 1);
                return;
            }
            
            if (event.key === 'ArrowRight' && index < this.length - 1) {
                event.preventDefault();
                this.focusInput(index + 1);
                return;
            }
            
            // Handle delete
            if (event.key === 'Delete') {
                this.values[index] = '';
                this.updateHiddenInput();
                @if($isLivewire && $livewireProperty)
                @if($attributes->has('wire:model.live'))
                $wire.set(this.wireProperty, this.getValue());
                @endif
                @endif
                event.preventDefault();
                return;
            }
        },
        
        handlePaste(value) {
            // Remove non-alphanumeric characters and limit to length
            const cleaned = value.replace(/[^a-zA-Z0-9]/g, '').slice(0, this.length);
            this.setValue(cleaned);
            
            // Focus last filled input or last input
            const lastFilledIndex = Math.min(cleaned.length - 1, this.length - 1);
            this.focusInput(lastFilledIndex);
        },
        
        handleFocus(index) {
            this.focusedIndex = index;
        },
        
        handleBlur(index) {
            @if($isLivewire && $livewireProperty)
            @if($attributes->has('wire:model.blur'))
            $wire.set(this.wireProperty, this.getValue());
            @elseif($attributes->has('wire:model.defer'))
            // Will update on next request
            @endif
            @endif
        }
    }"
    @foreach($ariaAttributes as $attr => $val)
        {{ $attr }}="{{ $val }}"
    @endforeach
    {{ $attributes->merge(['class' => 'w-full'])->except(['name', 'id', 'length', 'size', 'disabled', 'readonly', 'required', 'autofocus', 'help', 'errorMessage', 'label', 'type']) }}
>
    @if($label && $containerId)
        <x-slate::label 
            :for="$hiddenInputId" 
            :required="$required" 
            :size="$size" 
            :error="$hasError"
            class="mb-1"
        >
            {{ $label }}
        </x-slate::label>
    @endif
    
    <div class="flex items-center justify-center gap-2">
        @for($i = 0; $i < $length; $i++)
            <input
                type="{{ $type === 'password' ? 'password' : 'text' }}"
                id="{{ $containerId }}-{{ $i }}"
                maxlength="1"
                x-model="values[{{ $i }}]"
                @input="handleInput({{ $i }}, $event)"
                @keydown="handleKeydown({{ $i }}, $event)"
                @focus="handleFocus({{ $i }})"
                @blur="handleBlur({{ $i }})"
                @paste.prevent="handlePaste($event.clipboardData.getData('text'))"
                @if($disabled) disabled @endif
                @if($readonly) readonly @endif
                @if($i === 0 && $required) required @endif
                class="{{ $inputClasses }}"
                autocomplete="off"
                inputmode="text"
            />
        @endfor
    </div>
    
    {{-- Hidden input for form submission --}}
    <input
        type="hidden"
        id="{{ $hiddenInputId }}"
        @if($name) name="{{ $name }}" @endif
        x-bind:value="getValue()"
        @if($required) required @endif
    />
    
    @if($help && $containerId)
        <p id="{{ $containerId }}-help" class="mt-1 text-sm text-muted-foreground text-center">
            {{ $help }}
        </p>
    @endif
    
    @if($hasError && $finalErrorMessage && $containerId)
        <p id="{{ $containerId }}-error" class="mt-1 text-sm text-danger text-center">
            {{ $finalErrorMessage }}
        </p>
    @endif
</div>

