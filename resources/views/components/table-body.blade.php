{{-- table-body.blade.php --}}
@props([])

<tbody
    {{ $attributes->merge(['class' => '[&_tr:last-child]:border-0']) }}
>
    {{ $slot }}
</tbody>

