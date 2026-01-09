{{-- sheet-header.blade.php --}}
<div
    {{ $attributes->merge([
        'class' => 'flex flex-col space-y-2 text-center sm:text-left'
    ]) }}
>
    {{ $slot }}
</div>

