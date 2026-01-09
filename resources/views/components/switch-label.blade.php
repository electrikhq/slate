{{-- switch-label.blade.php --}}
@props([
    'for' => null,
])

<label
    @if($for) for="{{ $for }}" @endif
    {{ $attributes->merge([
        'class' => 'text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70'
    ]) }}
>
    {{ $slot }}
</label>

