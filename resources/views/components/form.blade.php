@props([
    'fullWidth' => false,  
])

@php
    $widthClass = ($fullWidth) ?  'w-full': 'max-w-xl lg:max-w-2xl';
@endphp

<form 
    {{ $attributes->class([
            'space-y-6 ' . $widthClass,
       ]) 
    }}
    {{ $attributes }}
>
    {{ $slot }}
</form>