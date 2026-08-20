<span data-slot="checkbox-root" class="relative inline-flex shrink-0 align-middle">
    <input
        type="checkbox"
        data-slot="checkbox"
        id="{{ $resolvedId }}"
        value="{{ $value }}"
        @if($resolvedName) name="{{ $resolvedName }}" @endif
        @if($resolvedAriaInvalid !== null) aria-invalid="{{ $resolvedAriaInvalid }}" @endif
        @if($describedBy !== '') aria-describedby="{{ $describedBy }}" @endif
        @checked($isChecked)
        {{ $controlAttributes->merge([
            'class' => 'peer absolute inset-0 z-10 m-0 size-4 cursor-pointer opacity-0 disabled:cursor-not-allowed',
        ]) }}
    />

    <span
        aria-hidden="true"
        class="inline-flex size-4 items-center justify-center border shadow-xs transition-[color,box-shadow,background-color,border-color] outline-none peer-focus-visible:border-ring peer-focus-visible:ring-[3px] peer-focus-visible:ring-ring/50 peer-disabled:opacity-50 peer-checked:border-primary peer-checked:bg-primary peer-checked:text-primary-foreground peer-checked:[&_svg]:scale-100 peer-checked:[&_svg]:opacity-100 {{ $indicatorClasses }} {{ $resolvedRounded }}"
    >
        <svg class="size-3.5 scale-75 opacity-0 transition-all" viewBox="0 0 24 24" fill="none">
            <path d="M20 6 9 17l-5-5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
        </svg>
    </span>
</span>
