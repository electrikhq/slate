{{-- sidebar-menu.blade.php --}}
<ul
    {{ $attributes->merge([
        'class' => 'space-y-1'
    ]) }}
>
    {{ $slot }}
</ul>

