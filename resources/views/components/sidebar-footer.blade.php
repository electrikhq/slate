{{-- sidebar-footer.blade.php --}}
<div
    {{ $attributes->merge([
        'class' => 'mt-auto border-t border-border p-4'
    ]) }}
>
    {{ $slot }}
</div>

