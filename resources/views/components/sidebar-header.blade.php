{{-- sidebar-header.blade.php --}}
<div
    {{ $attributes->merge([
        'class' => 'flex h-16 items-center border-b border-border px-6'
    ]) }}
>
    {{ $slot }}
</div>

