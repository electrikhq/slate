@props([
    'name' => null,
    'invalid' => null,
    'disabled' => false,
])

@php
    $resolvedInvalid = $invalid;

    if ($resolvedInvalid === null && $name) {
        $sharedErrors = $errors ?? (function_exists('view') && view()->shared('errors') ? view()->shared('errors') : null);
        $resolvedInvalid = $sharedErrors?->has($name) ?? false;
    }

    $resolvedInvalid = (bool) $resolvedInvalid;
@endphp

<div
    data-slot="field"
    data-invalid="{{ $resolvedInvalid ? 'true' : 'false' }}"
    data-disabled="{{ $disabled ? 'true' : 'false' }}"
    {{ $attributes->merge(['class' => 'group/field grid w-full gap-2']) }}
>
    {{ $slot }}
</div>
