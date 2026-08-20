<label
    data-slot="file-input-label"
    for="{{ $resolvedId }}"
    @class([
        'flex h-9 w-full min-w-0 cursor-pointer items-center rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-xs transition-[color,box-shadow] outline-none',
        'focus-within:border-ring focus-within:ring-[3px] focus-within:ring-ring/50',
        'has-[:disabled]:pointer-events-none has-[:disabled]:cursor-not-allowed has-[:disabled]:opacity-50',
        $isInvalid ? 'border-destructive ring-[3px] ring-destructive/20 dark:ring-destructive/40' : '',
    ])
    x-data="{ filename: '' }"
>
    <input
        type="file"
        data-slot="file-input"
        id="{{ $resolvedId }}"
        @if($resolvedName) name="{{ $resolvedName }}" @endif
        @if($resolvedAriaInvalid !== null) aria-invalid="{{ $resolvedAriaInvalid }}" @endif
        @if($describedBy !== '') aria-describedby="{{ $describedBy }}" @endif
        @change="filename = $event.target.files[0]?.name ?? ''"
        {{ $controlAttributes->merge(['class' => 'sr-only']) }}
    />
    <span class="truncate text-muted-foreground" x-show="!filename">{{ $placeholder ?? 'Choose a file' }}</span>
    <span class="truncate text-foreground" x-show="filename" x-text="filename" x-cloak></span>
</label>
