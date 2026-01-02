{{-- drawer-title.blade.php --}}
@props([
    'as' => 'h2',
])

<{{ $as }}
    class="text-lg font-semibold leading-none tracking-tight"
>
    {{ $slot }}
</{{ $as }}>

