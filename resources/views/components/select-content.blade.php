{{-- select-content.blade.php --}}
<div
    x-data="{
        parentData: null,
        init() {
            this.findParent();
            const checkParent = setInterval(() => {
                if (!this.parentData) {
                    this.findParent();
                } else {
                    clearInterval(checkParent);
                }
            }, 10);
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
        get isOpen() {
            if (!this.parentData) {
                this.findParent();
            }
            return this.parentData ? this.parentData.open : false;
        }
    }"
    x-show="isOpen"
    x-cloak
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="absolute z-50 mt-1 min-w-[8rem] overflow-hidden rounded-md border bg-popover text-popover-foreground shadow-md"
    {{ $attributes }}
>
    <div class="p-1">
        {{ $slot }}
    </div>
</div>

