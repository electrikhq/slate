{{-- combobox-input.blade.php --}}
@props([
    'placeholder' => 'Search...',
])

<div class="relative">
    <input
        type="text"
        x-model="search"
        @click="open = true"
        @focus="open = true"
        :value="selectedLabel || search"
        @input="search = $event.target.value; if (!open) open = true;"
        placeholder="{{ $placeholder }}"
        autocomplete="off"
        {{ $attributes->merge([
            'class' => 'flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 h-10'
        ]) }}
    />
    <button
        type="button"
        @click="open = !open"
        class="absolute right-0 top-0 h-full px-3 flex items-center"
        tabindex="-1"
    >
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
            class="h-4 w-4 opacity-50"
            :class="open ? 'rotate-180' : ''"
        >
            <path d="m6 9 6 6 6-6" />
        </svg>
    </button>
</div>

