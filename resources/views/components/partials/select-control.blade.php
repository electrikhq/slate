<div data-slot="select-wrapper" class="relative">
    <select
        data-slot="select"
        id="{{ $resolvedId }}"
        @if($resolvedName) name="{{ $resolvedName }}" @endif
        @if($resolvedAriaInvalid !== null) aria-invalid="{{ $resolvedAriaInvalid }}" @endif
        @if($describedBy !== '') aria-describedby="{{ $describedBy }}" @endif
        {{ $controlAttributes->merge(['class' => $classes]) }}
    >
        @if($placeholder !== null)
            <option value="" disabled hidden @selected(blank($currentValue))>{{ $placeholder }}</option>
        @endif

        {{ $slot }}
    </select>

    <span class="pointer-events-none absolute inset-y-0 end-3 inline-flex items-center text-muted-foreground">
        <svg class="size-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="m6 9 6 6 6-6" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
        </svg>
    </span>
</div>
