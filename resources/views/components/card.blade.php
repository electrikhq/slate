@props([
    'size' => 'md', // Default size
    'color' => 'neutral', // Default color
    'outlined' => false, // Outlined style
    'header' => null, // Optional header content
    'footer' => null, // Optional footer content
    'icon' => null, // Optional icon in the header
    'iconPosition' => 'before',
    'rounded' => true,
])

@php
use Electrik\Slate\SlateUiHelper;

$cardClasses = SlateUiHelper::getCardClasses($size, $color, $outlined, $rounded);
$borderClasses = SlateUiHelper::getBorderColor($color, $outlined);

@endphp

<div {{ $attributes->merge(['class' => "$cardClasses"]) }}>
    @if ($header)
        <div class="flex items-center {{ $borderClasses }} border-b px-2 py-2">
            @if ($icon && $iconPosition == 'before')
                <x-slate::icon :icon="$icon" size="sm" class="mr-2" />
            @endif
            <div class="flex-1">
                {{ $header }}
            </div>
            @if ($icon && $iconPosition == 'after')
                <x-slate::icon :icon="$icon" size="sm" class="ml-2" />
            @endif
        </div>
    @endif

    <div class="px-2 py-4">
        {{ $slot }}
    </div>

    @if ($footer)
        <div class="{{ $borderColorClass }} border-t px-2 py-2">
            {{ $footer }}
        </div>
    @endif
</div>
