{{-- carousel.blade.php --}}
@props([])

<div
    data-carousel
    x-data="{
        currentIndex: 0,
        total: 0,

        init() {
            this.total = this.$el.querySelectorAll('[data-carousel-item]').length
        },

        next() {
            if (!this.total) return
            this.currentIndex = (this.currentIndex + 1) % this.total
        },

        prev() {
            if (!this.total) return
            this.currentIndex =
                (this.currentIndex - 1 + this.total) % this.total
        },

        goTo(index) {
            if (index < 0 || index >= this.total) return
            this.currentIndex = index
        }
    }"
    class="relative w-full"
>
    {{ $slot }}
</div>
