@props([
    'title' => null,
    'description' => null,
    'as' => 'div',
])

@php
    $composed = filled($title) || filled($description) || isset($media) || isset($actions);
@endphp

<{{ $as }}
    data-slot="empty"
    {{ $attributes->merge(['class' => 'flex min-w-0 flex-1 flex-col items-center justify-center gap-6 rounded-lg border border-dashed p-6 text-center md:p-12']) }}
>
    @if($composed)
        <x-slate::empty-header>
            @isset($media)
                <x-slate::empty-media>{{ $media }}</x-slate::empty-media>
            @endisset

            @if(filled($title))
                <x-slate::empty-title>{{ $title }}</x-slate::empty-title>
            @endif

            @if(filled($description))
                <x-slate::empty-description>{{ $description }}</x-slate::empty-description>
            @endif
        </x-slate::empty-header>

        {{ $slot }}

        @isset($actions)
            <x-slate::empty-content>{{ $actions }}</x-slate::empty-content>
        @endisset
    @else
        {{ $slot }}
    @endif
</{{ $as }}>
