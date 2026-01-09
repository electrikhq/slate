{{-- timeline-description.blade.php --}}
<div
    {{ $attributes->merge([
        'class' => 'text-sm text-muted-foreground'
    ]) }}
>
    {{ $slot }}
</div>

