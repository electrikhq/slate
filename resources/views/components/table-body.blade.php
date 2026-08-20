@props([])

<tbody
    data-slot="table-body"
    {{ $attributes->merge(['class' => '[&_tr:last-child]:border-0']) }}
>
    {{ $slot }}
</tbody>
