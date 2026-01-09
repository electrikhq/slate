{{-- spotlight-group.blade.php --}}
@props([
    'heading' => null,
])

<div
    {{ $attributes->merge([
        'class' => 'px-2 py-1.5'
    ]) }}
>
    @if($heading)
        <div class="px-2 py-1.5 text-xs font-semibold text-muted-foreground">{{ $heading }}</div>
    @endif
    {{ $slot }}
</div>

