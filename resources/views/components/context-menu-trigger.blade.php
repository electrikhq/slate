{{-- context-menu-trigger.blade.php --}}
@props([])

<div
    @contextmenu.prevent="openAt($event)"
    {{ $attributes->merge(['class' => 'inline-block']) }}
>
    {{ $slot }}
</div>

