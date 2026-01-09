{{-- calendar.blade.php --}}
@props([
    'value' => null, // Selected date (YYYY-MM-DD format or Carbon/DateTime object)
    'mode' => 'single', // 'single' or 'range'
    'disabled' => false,
])

@php
    // Generate unique ID
    $calendarId = $attributes->get('id', 'calendar-' . uniqid());
    
    // Parse initial date
    $initialDate = null;
    if ($value) {
        if (is_string($value)) {
            try {
                $initialDate = \Carbon\Carbon::parse($value);
            } catch (\Exception $e) {
                $initialDate = \Carbon\Carbon::now();
            }
        } elseif (is_object($value) && method_exists($value, 'format')) {
            $initialDate = \Carbon\Carbon::parse($value->format('Y-m-d'));
        } else {
            $initialDate = \Carbon\Carbon::now();
        }
    } else {
        $initialDate = \Carbon\Carbon::now();
    }
    
    $currentMonth = $initialDate->format('Y-m');
    $currentYear = $initialDate->year;
    $currentMonthNum = $initialDate->month;
@endphp

<div
    x-data="{
        currentDate: new Date({{ $currentYear }}, {{ $currentMonthNum - 1 }}, 1),
        selectedDate: @js($value ? $initialDate->format('Y-m-d') : null),
        today: new Date(),
        
        get currentMonth() {
            return this.currentDate.getMonth();
        },
        
        get currentYear() {
            return this.currentDate.getFullYear();
        },
        
        get monthName() {
            return this.currentDate.toLocaleString('default', { month: 'long' });
        },
        
        get daysInMonth() {
            return new Date(this.currentYear, this.currentMonth + 1, 0).getDate();
        },
        
        get firstDayOfMonth() {
            return new Date(this.currentYear, this.currentMonth, 1).getDay();
        },
        
        get days() {
            const days = [];
            const firstDay = this.firstDayOfMonth;
            const daysInMonth = this.daysInMonth;
            
            // Add empty cells for days before the first day of the month
            for (let i = 0; i < firstDay; i++) {
                days.push(null);
            }
            
            // Add days of the month
            for (let day = 1; day <= daysInMonth; day++) {
                const date = new Date(this.currentYear, this.currentMonth, day);
                days.push({
                    day: day,
                    date: date,
                    dateString: this.formatDate(date),
                    isToday: this.isToday(date),
                    isSelected: this.isSelected(date),
                });
            }
            
            return days;
        },
        
        formatDate(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        },
        
        isToday(date) {
            return this.formatDate(date) === this.formatDate(this.today);
        },
        
        isSelected(date) {
            if (!this.selectedDate) return false;
            return this.formatDate(date) === this.selectedDate;
        },
        
        selectDate(dateString) {
            this.selectedDate = dateString;
            // Dispatch event for external use
            this.$dispatch('date-selected', { date: dateString });
        },
        
        previousMonth() {
            this.currentDate = new Date(this.currentYear, this.currentMonth - 1, 1);
        },
        
        nextMonth() {
            this.currentDate = new Date(this.currentYear, this.currentMonth + 1, 1);
        },
        
        goToToday() {
            this.currentDate = new Date(this.today.getFullYear(), this.today.getMonth(), 1);
        }
    }"
    x-id="['calendar']"
    wire:ignore
    id="{{ $calendarId }}"
    {{ $attributes->merge(['class' => 'rounded-md border border-border']) }}
>
    {{ $slot }}
</div>

