{{-- carousel-indicators.blade.php --}}
@props([])

<div class="absolute bottom-3 left-1/2 -translate-x-1/2 z-10 flex gap-2">
    <template x-for="(_, index) in Array.from({length: total}, (_, i) => i)" :key="index">
        <button
            type="button"
            @click="goTo(index)"
            :aria-current="index === currentIndex"
            class="h-2.5 w-2.5 rounded-full transition-colors
                   focus-visible:outline-none focus-visible:ring-2 
                   focus-visible:ring-ring focus-visible:ring-offset-2"
            :class="index === currentIndex
                ? 'bg-primary'
                : 'bg-primary/50 hover:bg-primary/75'"
            :aria-label="'Go to slide ' + (index + 1)"
        ></button>
    </template>
</div>
