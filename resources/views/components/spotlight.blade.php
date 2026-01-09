{{-- spotlight.blade.php --}}
@props([
    'id' => 'spotlight-' . uniqid(),
    'placeholder' => 'Search...',
    'shortcut' => '⌘K',
])

<div
    x-data="{
        open: false,
        search: '',
        selectedIndex: 0,
        items: [],
        id: '{{ $id }}',
        init() {
            // Listen for keyboard shortcut
            document.addEventListener('keydown', (e) => {
                if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                    e.preventDefault();
                    this.open = true;
                    this.$nextTick(() => {
                        this.$refs.input?.focus();
                    });
                }
                if (e.key === 'Escape' && this.open) {
                    this.open = false;
                }
            });
            
            // Collect items from slots
            this.$watch('open', (value) => {
                if (value) {
                    this.$nextTick(() => {
                        this.items = Array.from(this.$el.querySelectorAll('[data-spotlight-item]'));
                    });
                }
            });
        },
        close() {
            this.open = false;
            this.search = '';
            this.selectedIndex = 0;
        },
        selectItem(index) {
            if (this.items[index]) {
                const item = this.items[index];
                const clickEvent = new Event('click', { bubbles: true });
                item.dispatchEvent(clickEvent);
                this.close();
            }
        },
        handleKeydown(e) {
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                this.selectedIndex = Math.min(this.selectedIndex + 1, this.items.length - 1);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                this.selectedIndex = Math.max(this.selectedIndex - 1, 0);
            } else if (e.key === 'Enter') {
                e.preventDefault();
                this.selectItem(this.selectedIndex);
            }
        }
    }"
    x-id="['spotlight']"
    wire:ignore
    {{ $attributes->merge(['class' => 'relative']) }}
>
    {{ $slot }}
</div>

