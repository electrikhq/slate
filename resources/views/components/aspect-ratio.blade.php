{{-- aspect-ratio.blade.php --}}
@props([
    'ratio' => '16/9', // Common ratios: 16/9, 4/3, 1/1, 21/9, etc.
])

@php
    // Parse ratio (e.g., "16/9" -> 16/9 = 1.777...)
    $ratioParts = explode('/', $ratio);
    $width = (float)($ratioParts[0] ?? 16);
    $height = (float)($ratioParts[1] ?? 9);
    $aspectRatio = $width / $height;
    $paddingBottom = ($height / $width) * 100;
@endphp

<div
    {{ $attributes->merge(['class' => 'relative w-full']) }}
    style="padding-bottom: {{ $paddingBottom }}%;"
>
    <div class="absolute inset-0">
        {{ $slot }}
    </div>
</div>

