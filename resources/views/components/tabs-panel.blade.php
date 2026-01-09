{{-- tabs-panel.blade.php --}}
@props([
    'value' => null,
])

@php
    if ($value === null) {
        // Generate a value from slot content if not provided
        $slotContent = trim(strip_tags($slot->toHtml()));
        $panelValue = $slotContent ?: 'tab-' . uniqid();
    } else {
        $panelValue = $value;
    }
    $panelId = 'tabs-content-' . $panelValue;
@endphp

<div
    x-data="{
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
            return data.activeTab === '{{ $panelValue }}';
        }
    }"
    x-show="isActive"
    x-cloak
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    role="tabpanel"
    :id="$id('{{ $panelId }}')"
    :aria-labelledby="$id('tabs-trigger-{{ $panelValue }}')"
    {{ $attributes->merge([
        'class' => 'focus-visible:outline-none'
    ]) }}
>
    {{ $slot }}
</div>

