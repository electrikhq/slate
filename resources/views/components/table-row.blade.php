@props([])

<tr
    data-slot="table-row"
    {{ $attributes->merge(['class' => 'border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted']) }}
>
    {{ $slot }}
</tr>
