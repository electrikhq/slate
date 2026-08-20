<textarea
    rows="{{ $rows }}"
    data-slot="textarea"
    id="{{ $resolvedId }}"
    @if($resolvedName) name="{{ $resolvedName }}" @endif
    @if($resolvedAriaInvalid !== null) aria-invalid="{{ $resolvedAriaInvalid }}" @endif
    @if($describedBy !== '') aria-describedby="{{ $describedBy }}" @endif
    {{ $controlAttributes->merge(['class' => $classes]) }}
>{{ $slot }}</textarea>
