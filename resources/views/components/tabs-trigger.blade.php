{{-- tabs-trigger.blade.php --}}
@props([
    'value' => null,
    'disabled' => false,
])

@php
    if ($value === null) {
        // Generate a value from slot content if not provided
        $slotContent = trim(strip_tags($slot->toHtml()));
        $triggerValue = $slotContent ?: 'tab-' . uniqid();
    } else {
        $triggerValue = $value;
    }
    $baseClasses = 'inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50';
    $activeClasses = 'bg-background text-foreground shadow-sm';
    $inactiveClasses = 'hover:bg-background/50';
@endphp

<button
    type="button"
    role="tab"
    x-data="{
        init() {
            this.$watch('$root.activeTab', () => {
                // Force reactivity when activeTab changes
            });
        },
        get tabsData() {
            let tabs = this.$el.closest('[x-data]');
            while (tabs && tabs !== document.body) {
                if (tabs.__x && tabs.__x.$data && tabs.__x.$data.activeTab !== undefined) {
                    return tabs.__x.$data;
                }
                tabs = tabs.parentElement;
            }
            return null;
        },
        get isActive() {
            const data = this.tabsData;
            if (!data) return false;
            return data.activeTab === '{{ $triggerValue }}';
        },
        setActive() {
            const data = this.tabsData;
            if (data && typeof data.setActiveTab === 'function') {
                data.setActiveTab('{{ $triggerValue }}');
            }
        }
    }"
    :aria-selected="isActive"
    :aria-controls="$id('tabs-content-{{ $triggerValue }}')"
    @click.prevent.stop="setActive()"
    :class="isActive ? '{{ $baseClasses }} {{ $activeClasses }}' : '{{ $baseClasses }} {{ $inactiveClasses }}'"
    @if($disabled) disabled @endif
    {{ $attributes->except(['value', 'disabled']) }}
>
    {{ $slot }}
</button>

