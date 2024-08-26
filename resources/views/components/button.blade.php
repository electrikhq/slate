@props([
    'type' => 'button',
    'color' => 'primary',
    'size' => 'md',
    'outlined' => false,
    'rounded' => false,
    'disabled' => false,
    'href' => null,
    'icon' => null,
    'iconPosition' => 'before',
    'loading' => false,
    'fullWidth' => false,
])

@php
use Electrik\Slate\SlateUiHelper;

$classes = SlateUiHelper::getButtonClasses($size, $color, $outlined, $rounded, $disabled, $loading, $fullWidth);
$iconColor = (!$outlined) ? 'white' : $color;
@endphp

@if($href)
<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    @if($icon && $iconPosition === 'before') <x-slate::icon :icon="$icon" size="xs" color="$iconColor" class="mr-1"/> @endif
    {{ $slot }}
    @if($icon && $iconPosition === 'after') <x-slate::icon :icon="$icon" size="xs" color="$iconColor" class="ml-1"/> @endif
</a>
@else
<button type="{{ $type }}" {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => $classes]) }}>
    @if($loading)
        <span class="mr-1">
            <x-slate::icon icon="carbon-renew" class="animate-spin" size="xs" color="$iconColor"/>
        </span>
    @endif
    @if($icon && $iconPosition === 'before') <x-slate::icon :icon="$icon" size="xs" color="$iconColor" class="mr-1"/> @endif
    {{ $slot }}
    @if($icon && $iconPosition === 'after') <x-slate::icon :icon="$icon" size="xs" color="$iconColor" class="ml-1"/> @endif
</button>
@endif
