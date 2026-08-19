@props([
    'name' => null,
    'message' => null,
])

@php
    $sharedErrors = $errors ?? (function_exists('view') && view()->shared('errors') ? view()->shared('errors') : null);
    $resolvedMessage = $message;

    if ($resolvedMessage === null && $name) {
        $resolvedMessage = $sharedErrors?->first($name);
    }

    $identifier = $name ? str_replace(['.', '[', ']'], ['-', '-', ''], $name) : null;
    $resolvedId = $attributes->get('id') ?? ($identifier ? "{$identifier}-error" : null);
    $content = trim((string) $slot) !== '' ? $slot : $resolvedMessage;
@endphp

@if($content)
    <p
        data-slot="field-error"
        @if($resolvedId) id="{{ $resolvedId }}" @endif
        {{ $attributes->merge(['class' => 'text-sm text-destructive']) }}
    >
        {{ $content }}
    </p>
@endif
