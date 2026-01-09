{{-- carousel-content.blade.php --}}
@props([
    'height' => 'h-[400px]'
])

<div
    data-carousel-content
    {{ $attributes->merge([
        'class' => "relative w-full overflow-hidden rounded-lg {$height}"
    ]) }}
>
    <div
        class="flex h-full w-full transition-transform duration-500 ease-in-out"
        :style="`transform: translateX(-${currentIndex * 100}%)`"
    >
        {{ $slot }}
    </div>
</div>
