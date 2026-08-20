@props([
    'name' => null,
    'errorKey' => null,
    'label' => null,
    'description' => null,
    'help' => null,
    'errorMessage' => null,
    'showError' => null,
    'placeholder' => null,
    'accept' => null,
    'multiple' => false,
])

@php
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

    $resolvedId = $attributes->get('id') ?? ($identifier ? "file-input-{$identifier}" : 'file-input-'.uniqid());
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
        data-slot="file-input-field"
        @class([$fieldClass])
    >
        @if(filled($label))
            <x-slate::field-label :for="$resolvedId">{{ $label }}</x-slate::field-label>
        @endif

        @include('slate::components.partials.file-input-control')

        @if(filled($resolvedDescription))
            <x-slate::field-description :id="$descriptionId">{{ $resolvedDescription }}</x-slate::field-description>
        @endif

        @if($shouldShowError)
            <x-slate::field-error :name="$validationKey" :message="$errorMessage" />
        @endif
    </x-slate::field>
@else
    @include('slate::components.partials.file-input-control')
@endif
