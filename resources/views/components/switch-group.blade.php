{{-- switch-group.blade.php --}}
<div
    {{ $attributes->merge([
        'class' => 'flex items-center justify-between space-x-2'
    ]) }}
>
    <div class="space-y-0.5 flex-1">
        {{ $slot }}
    </div>
</div>

