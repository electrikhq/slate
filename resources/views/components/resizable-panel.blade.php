@props([
    'defaultSize' => null,
    'minSize' => 10,
    'index' => null,
    'as' => 'div',
])

@php
    $resolvedMin = max(5, (int) $minSize);
    $panelIndex = $index !== null ? (int) $index : 0;
@endphp

<{{ $as }}
    data-slot="resizable-panel"
    data-panel-index="{{ $panelIndex }}"
    data-min-size="{{ $resolvedMin }}"
    @if($defaultSize !== null) data-default-size="{{ $defaultSize }}" @endif
    x-bind:style="sizes.length ? `flex: ${sizes[{{ $panelIndex }}]} 0 0%` : 'flex: 1 0 0%'"
    {{ $attributes->merge(['class' => 'min-h-0 min-w-0 overflow-hidden']) }}
>
    {{ $slot }}
</{{ $as }}>
