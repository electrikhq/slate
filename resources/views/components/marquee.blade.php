@props([
    'duration' => 30,
    'reverse' => false,
    'pauseOnHover' => true,
    'as' => 'div',
])

@php
    $resolvedDuration = max(5, (int) $duration);
    $isReverse = filter_var($reverse, FILTER_VALIDATE_BOOL);
    $shouldPause = filter_var($pauseOnHover, FILTER_VALIDATE_BOOL);

    $classes = trim(implode(' ', [
        'group/marquee relative flex overflow-hidden',
        $shouldPause ? '[&:hover_.marquee-track]:[animation-play-state:paused]' : '',
    ]));
@endphp

<{{ $as }}
    data-slot="marquee"
    {{ $attributes->merge(['class' => $classes]) }}
>
    <div
        class="marquee-track flex min-w-full shrink-0 items-center gap-4"
        style="animation: marquee-scroll {{ $resolvedDuration }}s linear infinite {{ $isReverse ? 'reverse' : 'normal' }};"
    >
        {{ $slot }}
    </div>
    <div
        class="marquee-track flex min-w-full shrink-0 items-center gap-4"
        aria-hidden="true"
        style="animation: marquee-scroll {{ $resolvedDuration }}s linear infinite {{ $isReverse ? 'reverse' : 'normal' }};"
    >
        {{ $slot }}
    </div>
</{{ $as }}>

<style>
    @keyframes marquee-scroll {
        from { transform: translateX(0); }
        to { transform: translateX(-100%); }
    }
</style>
