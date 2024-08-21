@props([
    'header' => false, // Whether this is a header cell
    'align' => 'left', // Text alignment: 'left', 'center', 'right'
])

@php
$cellTag = $header ? 'th' : 'td';
$alignClass = match($align) {
    'center' => 'text-center',
    'right' => 'text-right',
    default => 'text-left',
};
$baseClasses = $header ? 'px-4 py-2 font-semibold' : 'px-4 py-2';
@endphp

<{{ $cellTag }} {{ $attributes->merge(['class' => "{$baseClasses} {$alignClass}"]) }}>
    {{ $slot }}
</{{ $cellTag }}>
