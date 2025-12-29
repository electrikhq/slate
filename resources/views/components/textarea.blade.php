@props([
    'size' => 'default',
    'disabled' => false,
    'readonly' => false,
    'required' => false,
    'autofocus' => false,
    'placeholder' => null,
    'name' => null,
    'id' => null,
    'rows' => 3,
    'cols' => null,
    'help' => null,
    'errorMessage' => null,
    'label' => null,
])

@php
    // Base classes - matching shadcn/ui exactly (same as Input)
    // Note: Removed file: classes as they're not applicable to textarea
    $baseClasses = 'flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 transition-colors resize-y';
    
    // Size classes - matching shadcn/ui exactly (same padding as Input)
    $sizeClasses = [
        'sm' => 'px-2.5 py-2 text-sm min-h-[72px]',
        'default' => 'px-3 py-2 text-sm min-h-[80px]',
        'lg' => 'px-4 py-2 text-sm min-h-[88px]',
    ];
    
    // Get size classes
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['default'];
    
    // Auto-detect Livewire
    $isLivewire = $attributes->has('wire:model') || 
                  $attributes->has('wire:model.live') ||
                  $attributes->has('wire:model.defer');
    
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
        if ($errors && $errors->has($name)) {
            $hasError = true;
            $finalErrorMessage = $errors->first($name);
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
    $textareaId = $id ?? ($name ? "textarea-{$name}" : null);
    
    // Build aria attributes
    $ariaAttributes = [];
    $describedBy = [];
    
    if ($hasError && $textareaId) {
        $ariaAttributes['aria-invalid'] = 'true';
        $describedBy[] = "{$textareaId}-error";
    }
    
    if ($help && $textareaId) {
        $describedBy[] = "{$textareaId}-help";
    }
    
    if ($required) {
        $ariaAttributes['aria-required'] = 'true';
    }
    
    if (!empty($describedBy)) {
        $ariaAttributes['aria-describedby'] = implode(' ', $describedBy);
    }
    
    // Get value from attributes (for Livewire or manual binding)
    // For textarea, value can come from: attributes, old() helper, or slot content
    $value = $attributes->get('value');
    if ($value === null && $name) {
        $value = old($name);
    }
    // Convert to string to avoid issues
    $value = $value !== null ? (string) $value : '';
@endphp

<div class="w-full">
    @if($label && $textareaId)
        <x-slate::label 
            :for="$textareaId" 
            :required="$required" 
            :size="$size" 
            :error="$hasError"
            class="mb-1"
        >
            {{ $label }}
        </x-slate::label>
    @endif
    
    <textarea
        @if($name) name="{{ $name }}" @endif
        @if($textareaId) id="{{ $textareaId }}" @endif
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        @if($rows) rows="{{ $rows }}" @endif
        @if($cols) cols="{{ $cols }}" @endif
        @if($disabled) disabled @endif
        @if($readonly) readonly @endif
        @if($required) required @endif
        @if($autofocus) autofocus @endif
        @foreach($ariaAttributes as $attr => $val)
            {{ $attr }}="{{ $val }}"
        @endforeach
        {{ $attributes->merge(['class' => $classes])->except(['name', 'id', 'placeholder', 'disabled', 'readonly', 'required', 'autofocus', 'rows', 'cols', 'size', 'help', 'errorMessage', 'label', 'value']) }}
    >{{ $value }}</textarea>
    
    @if($help && $textareaId)
        <p id="{{ $textareaId }}-help" class="mt-1 text-sm text-muted-foreground">
            {{ $help }}
        </p>
    @endif
    
    @if($hasError && $finalErrorMessage && $textareaId)
        <p id="{{ $textareaId }}-error" class="mt-1 text-sm text-danger">
            {{ $finalErrorMessage }}
        </p>
    @endif
</div>

