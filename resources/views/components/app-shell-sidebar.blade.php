{{-- app-shell-sidebar.blade.php --}}
@props([
    'collapsible' => true,
    'defaultOpen' => true,
    'width' => 'w-64',
    'collapsedWidth' => 'w-16',
])

<div
    x-data="{
        open: {{ $defaultOpen ? 'true' : 'false' }},
        collapsed: false,
        toggle() {
            this.open = !this.open;
        },
        collapse() {
            this.collapsed = !this.collapsed;
        }
    }"
    :class="{
        '{{ $width }}': open && !collapsed,
        '{{ $collapsedWidth }}': collapsed && open,
        'w-0': !open
    }"
    class="relative flex h-full flex-col border-r border-border bg-muted/50 transition-all duration-300 ease-in-out overflow-hidden"
    {{ $attributes }}
>
    {{ $slot }}
</div>

