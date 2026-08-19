<label
    data-slot="field-label"
    {{ $attributes->merge(['class' => 'text-sm font-medium leading-none group-data-[disabled=true]/field:cursor-not-allowed group-data-[disabled=true]/field:opacity-70 group-data-[invalid=true]/field:text-destructive']) }}
>
    {{ $slot }}
</label>
