@props([
    'as' => 'img',
])

<{{ $as }}
    data-slot="avatar-image"
    onerror="this.remove()"
    {{ $attributes->merge(['class' => 'absolute inset-0 aspect-square size-full rounded-full object-cover']) }}
/>
