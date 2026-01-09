{{-- app-shell-footer.blade.php --}}
@props([])

<footer
    class="flex-shrink-0 border-t border-border bg-background"
    {{ $attributes }}
>
    <div class="flex h-12 items-center px-4">
        {{ $slot }}
    </div>
</footer>

