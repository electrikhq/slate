{{-- calendar-grid.blade.php --}}
@props([])

<div
    {{ $attributes->merge([
        'class' => 'p-3 pt-0'
    ]) }}
>
    <div class="grid grid-cols-7 gap-0 text-center text-sm">
        <!-- Day headers -->
        <div class="flex h-9 items-center justify-center text-sm font-medium text-muted-foreground">Sun</div>
        <div class="flex h-9 items-center justify-center text-sm font-medium text-muted-foreground">Mon</div>
        <div class="flex h-9 items-center justify-center text-sm font-medium text-muted-foreground">Tue</div>
        <div class="flex h-9 items-center justify-center text-sm font-medium text-muted-foreground">Wed</div>
        <div class="flex h-9 items-center justify-center text-sm font-medium text-muted-foreground">Thu</div>
        <div class="flex h-9 items-center justify-center text-sm font-medium text-muted-foreground">Fri</div>
        <div class="flex h-9 items-center justify-center text-sm font-medium text-muted-foreground">Sat</div>
        
        <!-- Calendar days -->
        <template x-for="(day, index) in days" :key="index">
            <div>
                <template x-if="day === null">
                    <div class="h-9"></div>
                </template>
                <template x-if="day !== null">
                    <button
                        type="button"
                        @click="selectDate(day.dateString)"
                        :class="{
                            'bg-primary text-primary-foreground hover:bg-primary hover:text-primary-foreground focus:bg-primary focus:text-primary-foreground': day.isSelected,
                            'bg-accent text-accent-foreground': day.isToday && !day.isSelected,
                            'hover:bg-accent hover:text-accent-foreground': !day.isSelected && !day.isToday,
                        }"
                        class="flex h-9 w-9 items-center justify-center rounded-md p-0 text-sm font-normal transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50"
                    >
                        <span x-text="day.day"></span>
                    </button>
                </template>
            </div>
        </template>
    </div>
</div>

