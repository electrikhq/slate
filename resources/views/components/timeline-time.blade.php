{{-- timeline-time.blade.php --}}
<div
    {{ $attributes->merge([
        'class' => 'text-xs text-muted-foreground'
    ]) }}
>
    {{ $slot }}
</div>

