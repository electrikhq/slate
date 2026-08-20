@props([
    'size' => 'default',
    'src' => null,
    'alt' => '',
    'fallback' => null,
    'dot' => null,
    'as' => 'span',
])

@php
    $resolvedSize = in_array($size, ['default', 'sm', 'lg'], true) ? $size : 'default';

    // Overflow stays on the media layer so status dots / badges are not clipped.
    $classes = 'group/avatar relative flex size-8 shrink-0 rounded-full select-none data-[size=lg]:size-10 data-[size=sm]:size-6';

    $dotToneClasses = [
        'success' => 'bg-success',
        'warning' => 'bg-warning',
        'destructive' => 'bg-destructive',
        'info' => 'bg-info',
        'primary' => 'bg-primary',
        'muted' => 'bg-muted-foreground',
    ];

    $showDot = false;
    $dotClass = null;

    if ($dot === true || $dot === 1 || $dot === '1' || $dot === 'true') {
        $showDot = true;
        $dotClass = $dotToneClasses['success'];
    } elseif (is_string($dot) && array_key_exists($dot, $dotToneClasses)) {
        $showDot = true;
        $dotClass = $dotToneClasses[$dot];
    }

    $composed = filled($src) || filled($fallback) || $showDot;
@endphp

<{{ $as }}
    data-slot="avatar"
    data-size="{{ $resolvedSize }}"
    {{ $attributes->merge(['class' => $classes]) }}
>
    @if($composed)
        <span class="relative size-full overflow-hidden rounded-full">
            <x-slate::avatar-fallback>{{ $fallback ?? strtoupper(substr((string) ($alt ?: '?'), 0, 2)) }}</x-slate::avatar-fallback>
            @if(filled($src))
                <x-slate::avatar-image :src="$src" :alt="$alt" />
            @endif
        </span>

        {{ $slot }}

        @if($showDot)
            <x-slate::avatar-badge @class([$dotClass]) />
        @endif
    @else
        {{ $slot }}
    @endif
</{{ $as }}>
