@props([
    'value',
    'as' => 'button',
    'type' => 'button',
])

@php
    $baseClasses = 'inline-flex items-center justify-center gap-2 text-sm font-medium whitespace-nowrap transition-colors outline-none focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 bg-transparent hover:bg-muted hover:text-muted-foreground data-[state=on]:bg-accent data-[state=on]:text-accent-foreground';

    $groupOutline = 'group-data-[variant=outline]/toggle-group:border group-data-[variant=outline]/toggle-group:border-input group-data-[variant=outline]/toggle-group:bg-transparent group-data-[variant=outline]/toggle-group:shadow-xs group-data-[variant=outline]/toggle-group:hover:bg-accent group-data-[variant=outline]/toggle-group:hover:text-accent-foreground group-data-[variant=outline]/toggle-group:first:rounded-s-md group-data-[variant=outline]/toggle-group:last:rounded-e-md group-data-[variant=outline]/toggle-group:rounded-none group-data-[variant=outline]/toggle-group:border-s-0 group-data-[variant=outline]/toggle-group:first:border-s';

    $groupDefault = 'group-data-[variant=default]/toggle-group:rounded-md';

    $sizeClasses = 'group-data-[size=default]/toggle-group:h-9 group-data-[size=default]/toggle-group:min-w-9 group-data-[size=default]/toggle-group:px-2 group-data-[size=sm]/toggle-group:h-8 group-data-[size=sm]/toggle-group:min-w-8 group-data-[size=sm]/toggle-group:px-1.5 group-data-[size=lg]/toggle-group:h-10 group-data-[size=lg]/toggle-group:min-w-10 group-data-[size=lg]/toggle-group:px-2.5';

    $classes = trim("{$baseClasses} {$groupOutline} {$groupDefault} {$sizeClasses}");
@endphp

<{{ $as }}
    data-slot="toggle-group-item"
    data-value="{{ $value }}"
    @if($as === 'button') type="{{ $type }}" @endif
    @click="toggle(@js((string) $value))"
    x-bind:aria-pressed="isOn(@js((string) $value)) ? 'true' : 'false'"
    x-bind:data-state="isOn(@js((string) $value)) ? 'on' : 'off'"
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</{{ $as }}>
