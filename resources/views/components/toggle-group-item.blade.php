{{-- toggle-group-item.blade.php --}}
@props([
    'value',
    'disabled' => false,
    'size' => 'md', // sm, md, lg
])

@php
    $sizeClasses = [
        'sm' => 'h-9 px-2.5 text-xs',
        'md' => 'h-10 px-3 text-sm',
        'lg' => 'h-11 px-4 text-base',
    ][$size];
@endphp

<button
    type="button"
    role="switch"
    x-data="{
        get toggleGroup() {
            const group = this.$el.closest('[x-data]');
            return group && group.__x ? group.__x.$data : null;
        },
        get isPressed() {
            const group = this.toggleGroup;
            if (!group) return false;
            if (group.type === 'single') {
                return group.value === '{{ $value }}';
            } else {
                return Array.isArray(group.value) && group.value.includes('{{ $value }}');
            }
        },
        toggle() {
            const group = this.toggleGroup;
            if (group && group.toggle) {
                group.toggle('{{ $value }}');
            }
        }
    }"
    :aria-pressed="isPressed"
    @if($disabled) disabled @endif
    @click="toggle()"
    :class="isPressed 
        ? 'inline-flex items-center justify-center rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-background text-foreground shadow-sm {{ $sizeClasses }}'
        : 'inline-flex items-center justify-center rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-background/50 {{ $sizeClasses }}'"
    {{ $attributes->except(['value', 'disabled', 'size']) }}
>
    {{ $slot }}
</button>

