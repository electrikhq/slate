@props([
    'variant' => 'default',
    'size' => 'default',
    'rounded' => null,
    'animation' => 'none',
    'loading' => false,
    'loadingText' => null,
    'as' => 'button',
    'type' => 'button',
])

@php
    $roundedClasses = [
        'none' => 'rounded-none',
        'sm' => 'rounded-sm',
        'md' => 'rounded-md',
        'lg' => 'rounded-lg',
        'xl' => 'rounded-xl',
        'full' => 'rounded-full',
    ];

    $resolvedRounded = $roundedClasses[$rounded ?? 'md'] ?? $roundedClasses['md'];

    $svgSize = '[&_svg:not([class*="size-"])]:size-4';

    $baseClasses = "inline-flex shrink-0 items-center justify-center gap-2 whitespace-nowrap {$resolvedRounded} text-sm font-medium transition-all motion-reduce:transform-none motion-reduce:transition-none outline-none focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:pointer-events-none disabled:opacity-50 aria-invalid:border-destructive aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 [&_svg]:pointer-events-none [&_svg]:shrink-0 {$svgSize}";

    $variantClasses = [
        'default' => 'bg-primary text-primary-foreground hover:bg-primary/90',
        'secondary' => 'bg-secondary text-secondary-foreground hover:bg-secondary/80',
        'outline' => 'border bg-background shadow-xs hover:bg-accent hover:text-accent-foreground dark:border-input dark:bg-input/30 dark:hover:bg-input/50',
        'ghost' => 'hover:bg-accent hover:text-accent-foreground dark:hover:bg-accent/50',
        'destructive' => 'bg-destructive text-white shadow-xs hover:bg-destructive/90 focus-visible:ring-destructive/20 dark:focus-visible:ring-destructive/40',
        'link' => 'text-primary underline-offset-4 hover:underline',
    ];

    $sizeClasses = [
        'xs' => 'h-6 gap-1 px-2 text-xs has-[>svg]:px-1.5 [&_svg:not([class*="size-"])]:size-3',
        'sm' => 'h-8 gap-1.5 px-3 has-[>svg]:px-2.5 [&_svg:not([class*="size-"])]:size-4',
        'default' => 'h-9 px-4 py-2 has-[>svg]:px-3 [&_svg:not([class*="size-"])]:size-4',
        'lg' => 'h-10 px-6 has-[>svg]:px-4 [&_svg:not([class*="size-"])]:size-4',
        'icon-xs' => 'size-6 [&_svg:not([class*="size-"])]:size-3',
        'icon-sm' => 'size-8 [&_svg:not([class*="size-"])]:size-4',
        'icon' => 'size-9 [&_svg:not([class*="size-"])]:size-4',
        'icon-lg' => 'size-10 [&_svg:not([class*="size-"])]:size-4',
    ];

    $resolvedAnimation = $animation === 'auto'
        ? ($variant === 'link' ? 'none' : 'subtle')
        : $animation;

    $animationClasses = [
        'none' => '',
        'subtle' => 'motion-safe:hover:-translate-y-px motion-safe:active:translate-y-0',
        'lift' => 'motion-safe:hover:-translate-y-0.5 motion-safe:hover:shadow-sm motion-safe:active:translate-y-0',
    ];

    $isLoading = filter_var($loading, FILTER_VALIDATE_BOOL);

    $hasLivewireAction = $attributes->has('wire:click')
        || $attributes->has('wire:click.prevent')
        || $attributes->has('wire:click.stop')
        || $attributes->has('wire:submit')
        || $attributes->has('wire:submit.prevent');

    $wireTarget = $attributes->get('wire:target');

    $classes = trim(implode(' ', [
        $baseClasses,
        $variantClasses[$variant] ?? $variantClasses['default'],
        $sizeClasses[$size] ?? $sizeClasses['default'],
        $animationClasses[$resolvedAnimation] ?? $animationClasses['subtle'],
    ]));

    $isDisabled = $isLoading || filter_var($attributes->get('disabled'), FILTER_VALIDATE_BOOL);
    $mergedAttributes = $attributes
        ->except(['disabled'])
        ->merge(['class' => $classes]);
@endphp

<{{ $as }}
    data-slot="button"
    @if($as === 'button') type="{{ $type }}" @endif
    @if($as === 'button' && $hasLivewireAction && ! $isLoading && ! $attributes->has('wire:loading.attr')) wire:loading.attr="disabled" @endif
    @if($isDisabled) disabled @endif
    @if($isLoading) aria-busy="true" data-loading="true" @endif
    {{ $mergedAttributes }}
>
    @if($isLoading)
        <span class="inline-flex items-center gap-2" data-slot="button-loading">
            @include('slate::components.partials.button-spinner')
            <span>{{ $loadingText ?? $slot }}</span>
        </span>
    @elseif($hasLivewireAction && filled($loadingText))
        <span
            wire:loading.remove
            @if($wireTarget) wire:target="{{ $wireTarget }}" @endif
        >
            {{ $slot }}
        </span>
        <span
            class="inline-flex items-center gap-2"
            wire:loading.inline-flex
            @if($wireTarget) wire:target="{{ $wireTarget }}" @endif
        >
            @include('slate::components.partials.button-spinner')
            <span>{{ $loadingText }}</span>
        </span>
    @else
        @if($hasLivewireAction)
            <span
                class="hidden items-center"
                wire:loading.inline-flex
                @if($wireTarget) wire:target="{{ $wireTarget }}" @endif
            >
                @include('slate::components.partials.button-spinner')
            </span>
        @endif
        {{ $slot }}
    @endif
</{{ $as }}>
