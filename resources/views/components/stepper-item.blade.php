@props([
    'step' => 1,
    'title' => null,
    'description' => null,
    'as' => 'div',
])

@php
    $stepNumber = (int) $step;
    $composed = filled($title) || filled($description);
@endphp

<{{ $as }}
    data-slot="stepper-item"
    data-step="{{ $stepNumber }}"
    x-bind:data-state="current > {{ $stepNumber }} ? 'complete' : (current === {{ $stepNumber }} ? 'active' : 'inactive')"
    {{ $attributes->merge(['class' => 'flex flex-1 items-start gap-3']) }}
>
    <span
        data-slot="stepper-indicator"
        class="flex size-8 shrink-0 items-center justify-center rounded-full border text-sm font-medium transition-colors"
        x-bind:class="{
            'border-primary bg-primary text-primary-foreground': current >= {{ $stepNumber }},
            'border-border bg-background text-muted-foreground': current < {{ $stepNumber }}
        }"
    >
        <span x-show="current <= {{ $stepNumber }}">{{ $stepNumber }}</span>
        <svg x-show="current > {{ $stepNumber }}" x-cloak viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="size-4" aria-hidden="true">
            <path d="M20 6 9 17l-5-5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </span>

    @if($composed)
        <div class="grid gap-1 pt-1">
            @if(filled($title))
                <x-slate::stepper-title>{{ $title }}</x-slate::stepper-title>
            @endif
            @if(filled($description))
                <x-slate::stepper-description>{{ $description }}</x-slate::stepper-description>
            @endif
        </div>
    @else
        {{ $slot }}
    @endif
</{{ $as }}>
