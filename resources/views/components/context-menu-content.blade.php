{{-- context-menu-content.blade.php --}}
@props([])

<div
    x-show="open"
    x-cloak
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    @click.stop
    role="menu"
    :style="'position: fixed; left: ' + x + 'px; top: ' + y + 'px;'"
    class="z-50 min-w-[8rem] overflow-hidden rounded-md border border-border bg-popover text-popover-foreground shadow-md"
>
    <div class="p-1">
        {{ $slot }}
    </div>
</div>

