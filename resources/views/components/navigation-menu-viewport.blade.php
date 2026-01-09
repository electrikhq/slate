{{-- navigation-menu-viewport.blade.php --}}
@props([])

<div
    x-show="activeItem !== null"
    x-cloak
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 -translate-y-1"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-1"
    class="absolute left-0 top-full z-50 flex justify-center"
    style="perspective: 2000px;"
>
    <div class="relative mt-1.5 min-h-[200px] w-full origin-top overflow-hidden rounded-md border border-border bg-popover text-popover-foreground shadow-lg transition-[width,height] duration-300">
        <div class="absolute left-0 top-0 flex w-full justify-center">
            {{ $slot }}
        </div>
    </div>
</div>

