@props([])

<thead
    data-slot="table-header"
    {{ $attributes->merge(['class' => '[&_tr]:border-b']) }}
>
    {{ $slot }}
</thead>
