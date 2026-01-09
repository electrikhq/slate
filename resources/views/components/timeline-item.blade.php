{{-- timeline-item.blade.php --}}
@props([
    'active' => false,
    'icon' => null,
])

<div
    {{ $attributes->merge([
        'class' => 'relative flex items-start gap-4'
    ]) }}
>
    <div class="relative flex flex-col items-center">
        <div
            class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-border transition-colors {{ $active ? 'bg-primary text-primary-foreground' : 'bg-muted text-muted-foreground' }}"
        >
            @if($icon)
                {!! $icon !!}
            @else
                <div class="h-2 w-2 rounded-full bg-current"></div>
            @endif
        </div>
        <div class="absolute top-10 left-1/2 h-full w-0.5 -translate-x-1/2 bg-border last:hidden"></div>
    </div>
    <div class="flex-1 pb-8">
        {{ $slot }}
    </div>
</div>

