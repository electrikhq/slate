@props([
    'name' => null,
    'value' => '1',
    'checked' => false,
    'errorKey' => null,
    'label' => null,
    'description' => null,
    'errorMessage' => null,
    'showError' => null,
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

    $resolvedId = $attributes->get('id') ?? ($identifier ? 'radio-'.$identifier.'-'.md5((string) $value) : 'radio-'.uniqid());

    $composed = filled($label) || filled($description) || filled($errorMessage);
    // Radio groups often compose multiple labeled controls — only show errors when asked.
    $shouldShowError = $showError ?? filled($errorMessage);

    $describedBy = trim((string) $attributes->get('aria-describedby'));
    $descriptionId = filled($description) ? "{$resolvedId}-description" : null;
    $errorDescribedBy = ($hasError || filled($errorMessage)) && $identifier ? "{$identifier}-error" : null;

    foreach ([$descriptionId, $errorDescribedBy] as $idRef) {
        if ($idRef && ! str_contains(" {$describedBy} ", " {$idRef} ")) {
            $describedBy = trim($describedBy.' '.$idRef);
        }
    }

    $isChecked = filter_var($checked, FILTER_VALIDATE_BOOL);
    $resolvedAriaInvalid = $attributes->get('aria-invalid');

    if ($resolvedAriaInvalid === null && ($hasError || filled($errorMessage))) {
        $resolvedAriaInvalid = 'true';
    }

    $isInvalid = filter_var($resolvedAriaInvalid, FILTER_VALIDATE_BOOL);
    $isDisabled = filter_var($attributes->get('disabled'), FILTER_VALIDATE_BOOL);

    $indicatorClasses = $isInvalid
        ? 'border-destructive ring-[3px] ring-destructive/20 dark:ring-destructive/40'
        : 'border-primary';

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
        data-slot="radio-field"
        @class([$fieldClass])
    >
        <div @class(['flex gap-3', filled($description) ? 'items-start' : 'items-center'])>
            @include('slate::components.partials.radio-control')
            <div class="grid gap-1.5 leading-none">
                @if(filled($label))
                    <x-slate::field-label :for="$resolvedId">{{ $label }}</x-slate::field-label>
                @endif
                @if(filled($description))
                    <x-slate::field-description :id="$descriptionId">{{ $description }}</x-slate::field-description>
                @endif
            </div>
        </div>
        @if($shouldShowError)
            <x-slate::field-error :name="$validationKey" :message="$errorMessage" />
        @endif
    </x-slate::field>
@else
    @include('slate::components.partials.radio-control')
@endif
