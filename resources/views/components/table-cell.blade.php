@props([])

<td
    data-slot="table-cell"
    {{ $attributes->merge(['class' => 'p-2 align-middle whitespace-nowrap [&:has([role=checkbox])]:pe-0']) }}
>
    {{ $slot }}
</td>
