@props([
    'value' => null,
    'defaultValue' => null,
    'name' => null,
    'label' => null,
    'as' => 'div',
])

@php
    $initial = $value ?? $defaultValue ?? now()->format('Y-m-d');
    $resolvedName = $name ?? $attributes->get('name');
    $wireAttributes = $attributes->whereStartsWith('wire:model');
    $rootAttributes = $attributes->except(['name'])->whereDoesntStartWith('wire:');
    $ariaLabel = $label ?? $attributes->get('aria-label') ?? 'Choose a date';
    $labelId = ($attributes->get('id') ?? 'slate-calendar').'-label';
@endphp

<{{ $as }}
    data-slot="calendar"
    x-data="{
        value: @js((string) $initial),
        view: new Date(@js((string) $initial) + 'T00:00:00'),
        focusDay: new Date(@js((string) $initial) + 'T00:00:00').getDate(),
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
        iso(day) {
            const m = String(this.month + 1).padStart(2, '0');
            const d = String(day).padStart(2, '0');
            return `${this.year}-${m}-${d}`;
        },
        prevMonth() {
            this.view = new Date(this.year, this.month - 1, 1);
            this.focusDay = Math.min(this.focusDay, this.daysInMonth());
        },
        nextMonth() {
            this.view = new Date(this.year, this.month + 1, 1);
            this.focusDay = Math.min(this.focusDay, this.daysInMonth());
        },
        selectDay(day) {
            this.focusDay = day;
            this.value = this.iso(day);
            this.$dispatch('slate-calendar-change', { value: this.value });
            this.$nextTick(() => this.$refs.input?.dispatchEvent(new Event('input', { bubbles: true })));
        },
        isSelected(day) {
            return this.value === this.iso(day);
        },
        isToday(day) {
            const today = new Date();
            return today.getFullYear() === this.year && today.getMonth() === this.month && today.getDate() === day;
        },
        moveFocus(delta) {
            let next = this.focusDay + delta;
            if (next < 1) {
                this.prevMonth();
                this.focusDay = this.daysInMonth();
                return;
            }
            if (next > this.daysInMonth()) {
                this.nextMonth();
                this.focusDay = 1;
                return;
            }
            this.focusDay = next;
        },
        onGridKeydown(event) {
            switch (event.key) {
                case 'ArrowLeft': event.preventDefault(); this.moveFocus(-1); break;
                case 'ArrowRight': event.preventDefault(); this.moveFocus(1); break;
                case 'ArrowUp': event.preventDefault(); this.moveFocus(-7); break;
                case 'ArrowDown': event.preventDefault(); this.moveFocus(7); break;
                case 'Home': event.preventDefault(); this.focusDay = 1; break;
                case 'End': event.preventDefault(); this.focusDay = this.daysInMonth(); break;
                case 'PageUp': event.preventDefault(); this.prevMonth(); break;
                case 'PageDown': event.preventDefault(); this.nextMonth(); break;
                case 'Enter':
                case ' ':
                    event.preventDefault();
                    this.selectDay(this.focusDay);
                    break;
            }
        }
    }"
    {{ $rootAttributes->merge(['class' => 'w-[18rem] shrink-0 rounded-md border bg-background p-3']) }}
>
    <div class="flex items-center justify-between gap-2 pb-4">
        <button type="button" @click="prevMonth()" class="inline-flex size-7 shrink-0 items-center justify-center rounded-md border bg-transparent hover:bg-accent">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="size-4 rtl:rotate-180" aria-hidden="true">
                <path d="m15 18-6-6 6-6" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span class="sr-only">Previous month</span>
        </button>
        <div class="min-w-0 flex-1 truncate text-center text-sm font-medium" id="{{ $labelId }}" x-text="monthLabel"></div>
        <button type="button" @click="nextMonth()" class="inline-flex size-7 shrink-0 items-center justify-center rounded-md border bg-transparent hover:bg-accent">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="size-4 rtl:rotate-180" aria-hidden="true">
                <path d="m9 18 6-6-6-6" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span class="sr-only">Next month</span>
        </button>
    </div>

    <div
        role="grid"
        aria-labelledby="{{ $labelId }}"
        aria-label="{{ $ariaLabel }}"
        tabindex="0"
        class="w-full outline-none focus-visible:ring-2 focus-visible:ring-ring"
        @keydown="onGridKeydown($event)"
    >
        <div role="row" class="grid w-full grid-cols-7 gap-1 text-center text-xs text-muted-foreground">
            <span role="columnheader" class="flex size-8 items-center justify-center" aria-label="Sunday">Su</span>
            <span role="columnheader" class="flex size-8 items-center justify-center" aria-label="Monday">Mo</span>
            <span role="columnheader" class="flex size-8 items-center justify-center" aria-label="Tuesday">Tu</span>
            <span role="columnheader" class="flex size-8 items-center justify-center" aria-label="Wednesday">We</span>
            <span role="columnheader" class="flex size-8 items-center justify-center" aria-label="Thursday">Th</span>
            <span role="columnheader" class="flex size-8 items-center justify-center" aria-label="Friday">Fr</span>
            <span role="columnheader" class="flex size-8 items-center justify-center" aria-label="Saturday">Sa</span>
        </div>

        <div class="mt-2 grid w-full grid-cols-7 gap-1" role="rowgroup">
            <template x-for="day in daysInMonth()" :key="year + '-' + month + '-' + day">
                <button
                    type="button"
                    role="gridcell"
                    @click="selectDay(day)"
                    x-bind:style="day === 1 ? { gridColumnStart: firstDayOffset() + 1 } : null"
                    x-bind:tabindex="focusDay === day ? 0 : -1"
                    x-bind:aria-selected="isSelected(day) ? 'true' : 'false'"
                    x-bind:aria-current="isToday(day) ? 'date' : null"
                    class="inline-flex size-8 shrink-0 items-center justify-center justify-self-center rounded-md text-sm transition-colors hover:bg-accent focus-visible:outline-hidden focus-visible:ring-2 focus-visible:ring-ring"
                    x-bind:class="{
                        'bg-primary text-primary-foreground hover:bg-primary': isSelected(day),
                        'font-semibold text-primary': isToday(day) && !isSelected(day),
                        'ring-2 ring-ring': focusDay === day
                    }"
                    x-text="day"
                ></button>
            </template>
        </div>
    </div>

    <input
        type="hidden"
        x-ref="input"
        @if(filled($resolvedName)) name="{{ $resolvedName }}" @endif
        x-bind:value="value"
        {{ $wireAttributes }}
    />
    {{ $slot }}
</{{ $as }}>
