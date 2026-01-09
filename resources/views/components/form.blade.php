{{-- form.blade.php --}}
@props([
    'method' => 'POST',
    'action' => null,
])

@php
    // Handle method spoofing for PUT, PATCH, DELETE
    $method = strtoupper($method);
    $needsSpoofing = in_array($method, ['PUT', 'PATCH', 'DELETE']);
@endphp

<form
    @if($action) action="{{ $action }}" @endif
    method="{{ $needsSpoofing ? 'POST' : $method }}"
    {{ $attributes->except(['method', 'action']) }}
>
    @if($needsSpoofing)
        @method($method)
    @endif
    
    @csrf
    
    {{ $slot }}
</form>

