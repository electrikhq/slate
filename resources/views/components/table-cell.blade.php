{{-- table-cell.blade.php --}}
@props([])

<td
    {{ $attributes->merge(['class' => 'p-4 align-middle [&:has([role=checkbox])]:pr-0']) }}
>
    {{ $slot }}
</td>

