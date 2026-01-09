{{-- accordion-content.blade.php --}}
@props([])

<div
    x-show="isOpen(itemValue)"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 -translate-y-1"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-1"
    :id="'accordion-content-' + itemValue"
    role="region"
    :aria-labelledby="'accordion-trigger-' + itemValue"
    {{ $attributes->merge([
        'class' => 'overflow-hidden text-sm'
    ]) }}
>
    <div class="pb-4 pt-0">
        {{ $slot }}
    </div>
</div>

