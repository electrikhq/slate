@props([
    'name' => null,
    'value' => null,
    'defaultValue' => null,
    'orientation' => 'vertical',
    'label' => null,
    'description' => null,
    'errorMessage' => null,
    'errorKey' => null,
    'as' => 'fieldset',
])

@php
    $resolvedOrientation = in_array($orientation, ['horizontal', 'vertical'], true)
        ? $orientation
        : 'vertical';

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
    $resolvedId = $attributes->get('id') ?? ($identifier ? "radio-group-{$identifier}" : 'radio-group-'.uniqid());

    $initial = $value ?? $defaultValue ?? '';
    $composed = filled($label) || filled($description) || filled($errorMessage);

    $describedBy = trim((string) $attributes->get('aria-describedby'));
    $descriptionId = filled($description) ? "{$resolvedId}-description" : null;
    $errorDescribedBy = ($hasError || filled($errorMessage)) && $identifier ? "{$identifier}-error" : null;

    foreach ([$descriptionId, $errorDescribedBy] as $idRef) {
        if ($idRef && ! str_contains(" {$describedBy} ", " {$idRef} ")) {
            $describedBy = trim($describedBy.' '.$idRef);
        }
    }

    $isInvalid = $hasError || filled($errorMessage);
    $isDisabled = filter_var($attributes->get('disabled'), FILTER_VALIDATE_BOOL);

    $groupClasses = trim(implode(' ', [
        'grid gap-3',
        $resolvedOrientation === 'horizontal' ? 'grid-flow-col auto-cols-fr' : '',
    ]));

    $fieldClass = $composed ? $attributes->get('class') : null;
    $groupAttributes = $composed
        ? $attributes->except(['name', 'id', 'aria-describedby', 'aria-invalid', 'class', 'disabled'])
        : $attributes->except(['name', 'id', 'aria-describedby', 'aria-invalid', 'disabled']);
@endphp

@if($composed)
    <x-slate::field
        :name="$validationKey"
        :invalid="$isInvalid"
        :disabled="$isDisabled"
        data-slot="radio-group-field"
        @class([$fieldClass])
    >
        @if(filled($label))
            <legend class="text-sm font-medium leading-none">{{ $label }}</legend>
        @endif

        <{{ $as }}
            data-slot="radio-group"
            id="{{ $resolvedId }}"
            role="radiogroup"
            @if($describedBy !== '') aria-describedby="{{ $describedBy }}" @endif
            @if($isInvalid) aria-invalid="true" @endif
            x-data="{ value: @js((string) $initial) }"
            {{ $groupAttributes->merge(['class' => $groupClasses]) }}
        >
            {{ $slot }}
        </{{ $as }}>

        @if(filled($description))
            <x-slate::field-description :id="$descriptionId">{{ $description }}</x-slate::field-description>
        @endif

        @if(filled($errorMessage))
            <x-slate::field-error :name="$validationKey" :message="$errorMessage" />
        @endif
    </x-slate::field>
@else
    <{{ $as }}
        data-slot="radio-group"
        id="{{ $resolvedId }}"
        role="radiogroup"
        @if($resolvedName) data-name="{{ $resolvedName }}" @endif
        @if($describedBy !== '') aria-describedby="{{ $describedBy }}" @endif
        @if($isInvalid) aria-invalid="true" @endif
        x-data="{ value: @js((string) $initial) }"
        {{ $groupAttributes->merge(['class' => $groupClasses]) }}
    >
        {{ $slot }}
    </{{ $as }}>
@endif
