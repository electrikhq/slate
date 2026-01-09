{{-- sidebar-group.blade.php --}}
<div
    {{ $attributes->merge([
        'class' => 'space-y-1'
    ]) }}
>
    {{ $slot }}
</div>

