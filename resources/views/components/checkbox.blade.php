@props([
    'name' => null,
    'value' => '1',
    'checked' => false,
    'errorKey' => null,
    'rounded' => null,
])

@php
    $roundedClasses = [
        'none' => 'rounded-none',
        'sm' => 'rounded-sm',
        'md' => 'rounded-[4px]',
        'lg' => 'rounded-md',
        'xl' => 'rounded-lg',
        'full' => 'rounded-full',
    ];

    $resolvedRounded = $roundedClasses[$rounded ?? 'md'] ?? $roundedClasses['md'];

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

    $describedBy = trim((string) $attributes->get('aria-describedby'));
    $errorDescribedBy = $hasError && $identifier ? "{$identifier}-error" : null;

    if ($errorDescribedBy && ! str_contains(" {$describedBy} ", " {$errorDescribedBy} ")) {
        $describedBy = trim($describedBy . ' ' . $errorDescribedBy);
    }

    $isChecked = filter_var($checked, FILTER_VALIDATE_BOOL);
    $resolvedAriaInvalid = $attributes->get('aria-invalid');

    if ($resolvedAriaInvalid === null && $hasError) {
        $resolvedAriaInvalid = 'true';
    }

    $isInvalid = filter_var($resolvedAriaInvalid, FILTER_VALIDATE_BOOL);

    $indicatorClasses = $isInvalid
        ? 'border-destructive ring-[3px] ring-destructive/20 dark:ring-destructive/40'
        : 'border-primary';
@endphp

<span data-slot="checkbox-root" class="relative inline-flex shrink-0 align-middle">
    <input
        type="checkbox"
        data-slot="checkbox"
        value="{{ $value }}"
        @if($resolvedName) name="{{ $resolvedName }}" @endif
        @checked($isChecked)
        @if($resolvedAriaInvalid !== null) aria-invalid="{{ $resolvedAriaInvalid }}" @endif
        @if($describedBy) aria-describedby="{{ $describedBy }}" @endif
        {{ $attributes->except(['name', 'aria-describedby', 'aria-invalid'])->merge([
            'class' => 'peer absolute inset-0 z-10 m-0 size-4 cursor-pointer opacity-0 disabled:cursor-not-allowed',
        ]) }}
    />

    <span
        aria-hidden="true"
        class="inline-flex size-4 items-center justify-center border shadow-xs transition-[color,box-shadow,background-color,border-color] outline-none peer-focus-visible:border-ring peer-focus-visible:ring-[3px] peer-focus-visible:ring-ring/50 peer-disabled:opacity-50 peer-checked:border-primary peer-checked:bg-primary peer-checked:text-primary-foreground peer-checked:[&_svg]:scale-100 peer-checked:[&_svg]:opacity-100 {{ $indicatorClasses }} {{ $resolvedRounded }}"
    >
        <svg class="size-3.5 scale-75 opacity-0 transition-all" viewBox="0 0 24 24" fill="none">
            <path d="M20 6 9 17l-5-5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
        </svg>
    </span>
</span>
