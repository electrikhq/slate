{{-- sidebar-content.blade.php --}}
<div
    {{ $attributes->merge([
        'class' => 'flex-1 overflow-y-auto px-3 py-4'
    ]) }}
>
    {{ $slot }}
</div>

