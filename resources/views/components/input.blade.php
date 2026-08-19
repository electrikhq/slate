@props([
    'type' => 'text',
    'name' => null,
    'errorKey' => null,
    'rounded' => null,
])

@php
    $roundedClasses = [
        'none' => 'rounded-none',
        'sm' => 'rounded-sm',
        'md' => 'rounded-md',
        'lg' => 'rounded-lg',
        'xl' => 'rounded-xl',
        'full' => 'rounded-full',
    ];

    $resolvedRounded = $roundedClasses[$rounded ?? 'md'] ?? $roundedClasses['md'];

    $classes = "flex h-9 w-full min-w-0 {$resolvedRounded} border border-input bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none selection:bg-primary selection:text-primary-foreground file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 aria-invalid:border-destructive aria-invalid:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40";

    $wireModel = $attributes->get('wire:model')
        ?? $attributes->get('wire:model.live')
        ?? $attributes->get('wire:model.blur')
        ?? $attributes->get('wire:model.defer');

    $resolvedName = $name ?? $attributes->get('name');
    $validationKey = $errorKey ?? ($wireModel ? trim($wireModel, '\'"') : $resolvedName);

    $sharedErrors = $errors ?? (function_exists('view') && view()->shared('errors') ? view()->shared('errors') : null);
    $hasError = $validationKey && $sharedErrors?->has($validationKey);

    // Use validation key for error id wiring so FieldError can auto-match.
    $identifierSource = $resolvedName ?? $validationKey;
    $identifier = $identifierSource ? str_replace(['.', '[', ']'], ['-', '-', ''], $identifierSource) : null;

    $describedBy = trim((string) $attributes->get('aria-describedby'));
    $errorDescribedBy = $hasError && $identifier ? "{$identifier}-error" : null;

    if ($errorDescribedBy && ! str_contains(" {$describedBy} ", " {$errorDescribedBy} ")) {
        $describedBy = trim($describedBy . ' ' . $errorDescribedBy);
    }

    $resolvedAriaInvalid = $attributes->get('aria-invalid');

    if ($resolvedAriaInvalid === null && $hasError) {
        $resolvedAriaInvalid = 'true';
    }
@endphp

<input
    type="{{ $type }}"
    data-slot="input"
    @if($resolvedName) name="{{ $resolvedName }}" @endif
    @if($resolvedAriaInvalid !== null) aria-invalid="{{ $resolvedAriaInvalid }}" @endif
    @if($describedBy) aria-describedby="{{ $describedBy }}" @endif
    {{ $attributes->except(['name', 'aria-describedby', 'aria-invalid'])->merge(['class' => $classes]) }}
/>
