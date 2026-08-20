<span data-slot="switch-root" class="relative inline-flex shrink-0 align-middle">
    <input
        type="checkbox"
        role="switch"
        data-slot="switch"
        id="{{ $resolvedId }}"
        value="{{ $value }}"
        @if($resolvedName) name="{{ $resolvedName }}" @endif
        @if($resolvedAriaInvalid !== null) aria-invalid="{{ $resolvedAriaInvalid }}" @endif
        @if($describedBy !== '') aria-describedby="{{ $describedBy }}" @endif
        @checked($isChecked)
        {{ $controlAttributes->merge([
            'class' => 'peer absolute inset-0 z-10 m-0 h-[1.15rem] w-8 cursor-pointer opacity-0 disabled:cursor-not-allowed',
        ]) }}
    />

    <span
        aria-hidden="true"
        class="relative inline-flex h-[1.15rem] w-8 rounded-full border bg-input shadow-xs transition-[color,box-shadow,background-color,border-color] outline-none peer-focus-visible:border-ring peer-focus-visible:ring-[3px] peer-focus-visible:ring-ring/50 peer-disabled:opacity-50 peer-checked:bg-primary peer-checked:text-primary-foreground peer-checked:[&_span]:translate-x-3 rtl:peer-checked:[&_span]:-translate-x-3 dark:bg-input/80 dark:peer-checked:bg-primary dark:peer-checked:[&_span]:bg-primary-foreground {{ $trackClasses }}"
    >
        <span class="absolute start-px top-1/2 size-4 -translate-y-1/2 rounded-full bg-background shadow-sm transition-transform dark:bg-foreground"></span>
    </span>
</span>
