{{-- calendar-title.blade.php --}}
@props([])

<div
    {{ $attributes->merge([
        'class' => 'text-base font-semibold capitalize'
    ]) }}
>
    <span x-text="monthName + ' ' + currentYear"></span>
</div>

