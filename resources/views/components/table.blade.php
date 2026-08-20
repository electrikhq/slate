@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="table-container"
    {{ $attributes->merge(['class' => 'relative w-full overflow-x-auto']) }}
>
    <table data-slot="table" class="w-full caption-bottom text-sm">
        {{ $slot }}
    </table>
</{{ $as }}>
