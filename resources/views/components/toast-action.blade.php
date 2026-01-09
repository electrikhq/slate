{{-- toast-action.blade.php --}}
@props([
    'altText' => 'Action',
])

<button
    type="button"
    @click="$dispatch('toast-action', { id: $el.closest('[data-toast-id]')?.dataset.toastId })"
    class="inline-flex h-8 shrink-0 items-center justify-center rounded-md border border-transparent bg-transparent px-3 text-sm font-medium ring-offset-background transition-colors hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:pointer-events-none disabled:opacity-50"
    {{ $attributes }}
>
    {{ $slot }}
</button>

