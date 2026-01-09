{{-- timeline-title.blade.php --}}
<div
    {{ $attributes->merge([
        'class' => 'text-sm font-semibold text-foreground'
    ]) }}
>
    {{ $slot }}
</div>

