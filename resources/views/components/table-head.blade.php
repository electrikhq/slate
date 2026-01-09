{{-- table-head.blade.php --}}
@props([])

<th
    {{ $attributes->merge(['class' => 'h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0']) }}
>
    {{ $slot }}
</th>

