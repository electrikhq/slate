@props([
    'size' => 'md', // Default size
    'dismissible' => false, // Option to make the alert dismissible
    'icon' => null, // Optional icon
    'color' => 'primary', // Default color
    'outlined' => false, // Outlined style
    'fullWidth' => false, // Full-width style
])

@php

use Electrik\Slate\SlateUiHelper;

$alertClasses = SlateUIHelper::getAlertClasses($size, $color, $outlined, $fullWidth);
$fullWidthClass = $fullWidth ? 'w-full mx-0 px-2' : 'rounded-md shadow-sm';

// Dismissible button class
$dismissButtonClass = 'text-current hover:text-neutral-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 dark:hover:text-neutral-300';

// Merge all classes
$classes = implode(' ', [$alertClasses, 'flex items-center justify-between']);

@endphp

<div x-data="{ alertDismissed: false }" x-show="!alertDismissed" {{ $attributes->merge(['class' => $classes]) }}>
    <div class="flex items-center">
        @if ($icon)
            <x-slate::icon :icon="$icon" size="sm" class="mr-3"/>
        @endif
        <div class="flex-1">
            {{ $slot }}
        </div>
    </div>

    @if ($dismissible)
        <button type="button" class="ml-3 {{ $dismissButtonClass }}" aria-label="Dismiss" @click="alertDismissed = true">
            <x-slate::icon icon="carbon-close" size="sm" />
        </button>
    @endif
</div>
