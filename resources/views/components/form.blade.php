<form 
    {{ $attributes->class([
            'space-y-6',
       ]) 
    }}
    {{ $attributes }}
>
    {{ $slot }}
</form>