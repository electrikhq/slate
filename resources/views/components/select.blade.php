@props([
    'name' => null,
    'errorKey' => null,
    'rounded' => null,
    'placeholder' => null,
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

    $classes = "flex h-9 w-full min-w-0 appearance-none {$resolvedRounded} border border-input bg-transparent px-3 py-2 pe-9 text-base shadow-xs transition-[color,box-shadow] outline-none disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 aria-invalid:border-destructive aria-invalid:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40";

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

    $resolvedAriaInvalid = $attributes->get('aria-invalid');

    if ($resolvedAriaInvalid === null && $hasError) {
        $resolvedAriaInvalid = 'true';
    }

    $currentValue = $attributes->get('value');

    if ($currentValue === null && $resolvedName) {
        $currentValue = old($resolvedName);
    }
@endphp

<div data-slot="select-wrapper" class="relative">
    <select
        data-slot="select"
        @if($resolvedName) name="{{ $resolvedName }}" @endif
        @if($resolvedAriaInvalid !== null) aria-invalid="{{ $resolvedAriaInvalid }}" @endif
        @if($describedBy) aria-describedby="{{ $describedBy }}" @endif
        {{ $attributes->except(['name', 'aria-describedby', 'aria-invalid'])->merge(['class' => $classes]) }}
    >
        @if($placeholder !== null)
            <option value="" disabled hidden @selected(blank($currentValue))>{{ $placeholder }}</option>
        @endif

        {{ $slot }}
    </select>

    <span class="pointer-events-none absolute inset-y-0 end-3 inline-flex items-center text-muted-foreground">
        <svg class="size-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="m6 9 6 6 6-6" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
        </svg>
    </span>
</div>
