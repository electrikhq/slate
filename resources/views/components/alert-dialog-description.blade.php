{{-- alert-dialog-description.blade.php --}}
@props([
    'as' => 'p',
])

<{{ $as }}
    class="text-sm text-muted-foreground"
>
    {{ $slot }}
</{{ $as }}>

