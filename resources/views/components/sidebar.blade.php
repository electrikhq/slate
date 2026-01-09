{{-- sidebar.blade.php --}}
@props([
    'collapsible' => false,
    'defaultOpen' => true,
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
        },
        get width() {
            if (!this.open) return '0px';
            if (this.collapsed) return '4rem';
            return '16rem';
        }
    }"
    @toggle-sidebar.window="toggle()"
    data-sidebar-component="true"
    x-bind:style="'width: ' + width + '; min-width: ' + width"
    :class="{
        'overflow-hidden': !open
    }"
    class="relative flex h-full flex-col border-r border-border bg-background transition-all duration-300 {{ $attributes->get('class') }}"
    {{ $attributes->except('class') }}
>
    {{ $slot }}
</div>

