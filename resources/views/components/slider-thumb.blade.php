{{-- slider-thumb.blade.php --}}
<div
    {{ $attributes->merge([
        'class' => 'absolute h-5 w-5 -translate-x-1/2 rounded-full border-2 border-primary bg-background ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2'
    ]) }}
>
    {{ $slot }}
</div>

