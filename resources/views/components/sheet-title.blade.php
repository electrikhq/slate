{{-- sheet-title.blade.php --}}
<h2
    :id="$id('sheet-title')"
    {{ $attributes->merge([
        'class' => 'text-lg font-semibold text-foreground'
    ]) }}
>
    {{ $slot }}
</h2>

