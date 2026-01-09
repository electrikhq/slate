{{-- app-shell-header.blade.php --}}
@props([])

<header
    class="flex-shrink-0 border-b border-border bg-background"
    {{ $attributes->merge(['class' => 'sticky top-0 z-10']) }}
>
    <div class="flex h-16 items-center px-4">
        {{ $slot }}
    </div>
</header>

