{{-- sheet-description.blade.php --}}
<p
    :id="$id('sheet-description')"
    {{ $attributes->merge([
        'class' => 'text-sm text-muted-foreground'
    ]) }}
>
    {{ $slot }}
</p>

