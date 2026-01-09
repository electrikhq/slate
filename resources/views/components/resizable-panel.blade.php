{{-- resizable-panel.blade.php --}}
@props([
    'defaultSize' => 50, // Default size percentage
    'minSize' => 10, // Minimum size percentage
    'maxSize' => 90, // Maximum size percentage
])

@php
    $panelId = $attributes->get('id', 'panel-' . uniqid());
    $initialSize = max($minSize, min($maxSize, (float)$defaultSize));
@endphp

<div
    x-data="{
        size: {{ $initialSize }},
        minSize: {{ $minSize }},
        maxSize: {{ $maxSize }}
    }"
    data-resizable-panel="true"
    :style="'flex: 0 0 ' + size + '%'"
    {{ $attributes->merge([
        'class' => 'relative overflow-hidden'
    ]) }}
>
    {{ $slot }}
</div>

