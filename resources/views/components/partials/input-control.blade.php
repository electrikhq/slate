<input
    type="{{ $type }}"
    data-slot="input"
    id="{{ $resolvedId }}"
    @if($resolvedName) name="{{ $resolvedName }}" @endif
    @if($resolvedAriaInvalid !== null) aria-invalid="{{ $resolvedAriaInvalid }}" @endif
    @if($describedBy !== '') aria-describedby="{{ $describedBy }}" @endif
    {{ $controlAttributes->merge(['class' => $classes]) }}
/>
