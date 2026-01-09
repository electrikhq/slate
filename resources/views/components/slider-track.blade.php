{{-- slider-track.blade.php --}}
<div
    {{ $attributes->merge([
        'class' => 'relative h-2 w-full grow overflow-hidden rounded-full bg-secondary'
    ]) }}
>
    {{ $slot }}
</div>

