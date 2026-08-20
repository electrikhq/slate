<span data-slot="radio-root" class="relative inline-flex shrink-0 align-middle">
    <input
        type="radio"
        data-slot="radio"
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
        class="inline-flex size-4 items-center justify-center rounded-full border shadow-xs transition-[color,box-shadow,background-color,border-color] outline-none peer-focus-visible:border-ring peer-focus-visible:ring-[3px] peer-focus-visible:ring-ring/50 peer-disabled:opacity-50 peer-checked:border-primary peer-checked:[&_span]:scale-100 peer-checked:[&_span]:opacity-100 {{ $indicatorClasses }}"
    >
        <span class="size-2 rounded-full bg-primary scale-0 opacity-0 transition-all"></span>
    </span>
</span>
