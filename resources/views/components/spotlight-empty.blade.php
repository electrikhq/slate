{{-- spotlight-empty.blade.php --}}
<div
    {{ $attributes->merge([
        'class' => 'py-6 text-center text-sm text-muted-foreground'
    ]) }}
>
    {{ $slot }}
</div>

