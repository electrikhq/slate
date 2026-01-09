{{-- select-trigger.blade.php --}}
@props([
    'placeholder' => 'Select an option...',
    'disabled' => false,
    'size' => 'default',
])

@php
    // Size classes
    $sizeClasses = [
        'sm' => 'h-9 px-2.5 text-sm',
        'default' => 'h-10 px-3 py-2 text-sm',
        'lg' => 'h-11 px-4 text-sm',
    ];
    
    // Get size classes
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['default'];
@endphp

<button
    type="button"
    x-data="{
        parentData: null,
        init() {
            // Wait for parent Alpine instance to be ready
            this.findParent();
            // Also watch for when parent becomes available
            const checkParent = setInterval(() => {
                if (!this.parentData) {
                    this.findParent();
                } else {
                    clearInterval(checkParent);
                }
            }, 10);
            // Stop checking after 1 second
            setTimeout(() => clearInterval(checkParent), 1000);
        },
        findParent() {
            let parent = this.$el.parentElement;
            while (parent && parent !== document.body) {
                if (parent.hasAttribute('data-select-component')) {
                    if (parent.__x && parent.__x.$data) {
                        this.parentData = parent.__x.$data;
                        return;
                    }
                }
                parent = parent.parentElement;
            }
        },
        toggle() {
            if (!this.parentData) {
                this.findParent();
            }
            if (this.parentData) {
                this.parentData.open = !this.parentData.open;
            }
        },
        get isOpen() {
            if (!this.parentData) {
                this.findParent();
            }
            return this.parentData ? this.parentData.open : false;
        },
        get selectedOption() {
            if (!this.parentData) {
                this.findParent();
            }
            return this.parentData ? this.parentData.selectedOption : null;
        }
    }"
    @click.stop="toggle()"
    :aria-expanded="isOpen"
    :aria-haspopup="true"
    :disabled="{{ $disabled ? 'true' : 'false' }}"
    {{ $attributes->except(['size'])->merge([
        'class' => "flex w-full items-center justify-between rounded-md border border-input bg-background {$sizeClass} ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
    ]) }}
>
    <span x-text="selectedOption ? selectedOption.textContent.trim() : '{{ $placeholder }}'" :class="selectedOption ? 'text-foreground' : 'text-muted-foreground'"></span>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        width="16"
        height="16"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round"
        class="h-4 w-4 opacity-50 transition-transform"
        :class="isOpen ? 'rotate-180' : ''"
    >
        <polyline points="6 9 12 15 18 9" />
    </svg>
</button>

