@props([
    'value' => null,
    'defaultValue' => null,
    'name' => null,
    'as' => 'div',
])

@php
    $initial = $value ?? $defaultValue ?? now()->format('Y-m-d');
    $resolvedName = $name ?? $attributes->get('name');
    $rootAttributes = $attributes->except(['name']);
@endphp

<{{ $as }}
    data-slot="calendar"
    x-data="{
        value: @js((string) $initial),
        view: new Date(@js((string) $initial) + 'T00:00:00'),
        get year() { return this.view.getFullYear(); },
        get month() { return this.view.getMonth(); },
        get monthLabel() {
            return this.view.toLocaleDateString(undefined, { month: 'long', year: 'numeric' });
        },
        daysInMonth() {
            return new Date(this.year, this.month + 1, 0).getDate();
        },
        firstDayOffset() {
            return new Date(this.year, this.month, 1).getDay();
        },
        prevMonth() {
            this.view = new Date(this.year, this.month - 1, 1);
        },
        nextMonth() {
            this.view = new Date(this.year, this.month + 1, 1);
        },
        selectDay(day) {
            const m = String(this.month + 1).padStart(2, '0');
            const d = String(day).padStart(2, '0');
            this.value = `${this.year}-${m}-${d}`;
        },
        isSelected(day) {
            const m = String(this.month + 1).padStart(2, '0');
            const d = String(day).padStart(2, '0');
            return this.value === `${this.year}-${m}-${d}`;
        },
        isToday(day) {
            const today = new Date();
            return today.getFullYear() === this.year && today.getMonth() === this.month && today.getDate() === day;
        }
    }"
    {{ $rootAttributes->merge(['class' => 'w-fit rounded-md border bg-background p-3']) }}
>
    <div class="flex items-center justify-between pb-4">
        <button type="button" @click="prevMonth()" class="inline-flex size-7 items-center justify-center rounded-md border bg-transparent hover:bg-accent">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="size-4 rtl:rotate-180" aria-hidden="true">
                <path d="m15 18-6-6 6-6" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span class="sr-only">Previous month</span>
        </button>
        <div class="text-sm font-medium" x-text="monthLabel"></div>
        <button type="button" @click="nextMonth()" class="inline-flex size-7 items-center justify-center rounded-md border bg-transparent hover:bg-accent">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="size-4 rtl:rotate-180" aria-hidden="true">
                <path d="m9 18 6-6-6-6" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span class="sr-only">Next month</span>
        </button>
    </div>

    <div class="grid grid-cols-7 gap-1 text-center text-xs text-muted-foreground">
        <span>Su</span><span>Mo</span><span>Tu</span><span>We</span><span>Th</span><span>Fr</span><span>Sa</span>
    </div>

    <div class="mt-2 grid grid-cols-7 gap-1">
        <template x-for="blank in firstDayOffset()" :key="'b-' + blank">
            <span></span>
        </template>
        <template x-for="day in daysInMonth()" :key="day">
            <button
                type="button"
                @click="selectDay(day)"
                class="inline-flex size-8 items-center justify-center rounded-md text-sm transition-colors hover:bg-accent focus-visible:outline-hidden focus-visible:ring-2 focus-visible:ring-ring"
                x-bind:class="{
                    'bg-primary text-primary-foreground hover:bg-primary': isSelected(day),
                    'font-semibold text-primary': isToday(day) && !isSelected(day)
                }"
                x-text="day"
            ></button>
        </template>
    </div>

    @if(filled($resolvedName))
        <input type="hidden" name="{{ $resolvedName }}" x-bind:value="value" />
    @endif
    {{ $slot }}
</{{ $as }}>

