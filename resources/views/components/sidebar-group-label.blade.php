{{-- sidebar-group-label.blade.php --}}
<div
    {{ $attributes->merge([
        'class' => 'px-2 py-1.5 text-xs font-semibold text-muted-foreground'
    ]) }}
>
    {{ $slot }}
</div>

