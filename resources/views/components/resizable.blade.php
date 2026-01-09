{{-- resizable.blade.php --}}
@props([
    'direction' => 'horizontal', // 'horizontal' or 'vertical'
])

@php
    $resizableId = $attributes->get('id', 'resizable-' . uniqid());
    $isHorizontal = $direction === 'horizontal';
    $containerClass = $isHorizontal ? 'flex-row' : 'flex-col';
@endphp

<div
    x-data="{
        direction: '{{ $direction }}',
        isHorizontal: {{ $isHorizontal ? 'true' : 'false' }}
    }"
    x-id="['resizable']"
    data-resizable="true"
    wire:ignore
    id="{{ $resizableId }}"
    {{ $attributes->merge([
        'class' => 'flex w-full ' . $containerClass
    ]) }}
>
    {{ $slot }}
</div>

