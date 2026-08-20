@props([
    'name' => null,
    'errorKey' => null,
    'rows' => 4,
    'rounded' => null,
    'label' => null,
    'description' => null,
    'help' => null,
    'errorMessage' => null,
    'showError' => null,
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

    $classes = "flex min-h-16 w-full {$resolvedRounded} border border-input bg-transparent px-3 py-2 text-base shadow-xs transition-[color,box-shadow] outline-none selection:bg-primary selection:text-primary-foreground placeholder:text-muted-foreground disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 resize-y md:text-sm focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 aria-invalid:border-destructive aria-invalid:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40";

    $wireModel = $attributes->get('wire:model')
        ?? $attributes->get('wire:model.live')
        ?? $attributes->get('wire:model.blur')
        ?? $attributes->get('wire:model.defer');

    $resolvedName = $name ?? $attributes->get('name');
    $validationKey = $errorKey ?? ($wireModel ? trim($wireModel, '\'"') : $resolvedName);

    $sharedErrors = $errors ?? (function_exists('view') && view()->shared('errors') ? view()->shared('errors') : null);
    $hasError = $validationKey && $sharedErrors?->has($validationKey);

    $identifierSource = $resolvedName ?? $validationKey;
    $identifier = $identifierSource ? str_replace(['.', '[', ']'], ['-', '-', ''], $identifierSource) : null;

    $resolvedId = $attributes->get('id') ?? ($identifier ? "textarea-{$identifier}" : 'textarea-'.uniqid());
    $resolvedDescription = $description ?? $help;

    $composed = filled($label) || filled($resolvedDescription) || filled($errorMessage);
    $shouldShowError = $showError ?? $composed;

    $describedBy = trim((string) $attributes->get('aria-describedby'));
    $descriptionId = filled($resolvedDescription) ? "{$resolvedId}-description" : null;
    $errorDescribedBy = ($hasError || filled($errorMessage)) && $identifier ? "{$identifier}-error" : null;

    foreach ([$descriptionId, $errorDescribedBy] as $idRef) {
        if ($idRef && ! str_contains(" {$describedBy} ", " {$idRef} ")) {
            $describedBy = trim($describedBy.' '.$idRef);
        }
    }

    $resolvedAriaInvalid = $attributes->get('aria-invalid');

    if ($resolvedAriaInvalid === null && ($hasError || filled($errorMessage))) {
        $resolvedAriaInvalid = 'true';
    }

    $isInvalid = filter_var($resolvedAriaInvalid, FILTER_VALIDATE_BOOL);
    $isDisabled = filter_var($attributes->get('disabled'), FILTER_VALIDATE_BOOL);

    $fieldClass = $composed ? $attributes->get('class') : null;
    $controlAttributes = $composed
        ? $attributes->except(['name', 'id', 'aria-describedby', 'aria-invalid', 'class'])
        : $attributes->except(['name', 'id', 'aria-describedby', 'aria-invalid']);
@endphp

@if($composed)
    <x-slate::field
        :name="$validationKey"
        :invalid="$isInvalid"
        :disabled="$isDisabled"
        data-slot="textarea-field"
        @class([$fieldClass])
    >
        @if(filled($label))
            <x-slate::field-label :for="$resolvedId">{{ $label }}</x-slate::field-label>
        @endif

        @include('slate::components.partials.textarea-control')

        @if(filled($resolvedDescription))
            <x-slate::field-description :id="$descriptionId">{{ $resolvedDescription }}</x-slate::field-description>
        @endif

        @if($shouldShowError)
            <x-slate::field-error :name="$validationKey" :message="$errorMessage" />
        @endif
    </x-slate::field>
@else
    @include('slate::components.partials.textarea-control')
@endif
