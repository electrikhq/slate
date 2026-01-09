{{-- command-input.blade.php --}}
@props([
    'placeholder' => 'Type a command or search...',
])

<div class="flex items-center border-b border-border px-3">
    <svg
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="24"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round"
        class="mr-2 h-4 w-4 shrink-0 opacity-50"
    >
        <circle cx="11" cy="11" r="8" />
        <path d="m21 21-4.3-4.3" />
    </svg>
    <input
        type="text"
        x-model="search"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => 'flex h-11 w-full rounded-md bg-transparent py-3 text-sm outline-none placeholder:text-muted-foreground disabled:cursor-not-allowed disabled:opacity-50'
        ]) }}
    />
</div>

