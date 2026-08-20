@props([
    'as' => 'div',
])

{{--
    Height animates via grid-template-rows (0fr ↔ 1fr), matching the smooth
    expand/collapse feel of height-based accordion animations — without x-show,
    which toggles display and causes flicker.
--}}
<{{ $as }}
    data-slot="accordion-content"
    role="region"
    x-bind:aria-hidden="! isOpen($el.closest('[data-slot=accordion-item]')?.dataset.value)"
    x-bind:data-state="isOpen($el.closest('[data-slot=accordion-item]')?.dataset.value) ? 'open' : 'closed'"
    x-bind:class="mounted && 'transition-[grid-template-rows] duration-200 ease-out motion-reduce:transition-none'"
    {{ $attributes->merge(['class' => 'grid grid-rows-[0fr] text-sm group-data-[state=open]/accordion-item:grid-rows-[1fr]']) }}
>
    <div class="min-h-0 overflow-hidden">
        <div class="pt-0 pb-4 text-muted-foreground">
            {{ $slot }}
        </div>
    </div>
</{{ $as }}>
