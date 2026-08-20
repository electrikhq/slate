@props([
    'as' => 'p',
])

<{{ $as }}
    data-slot="empty-description"
    {{ $attributes->merge(['class' => 'text-sm/relaxed text-muted-foreground [&>a]:underline [&>a]:underline-offset-4 [&>a:hover]:text-primary']) }}
>
    {{ $slot }}
</{{ $as }}>
