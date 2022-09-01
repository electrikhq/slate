@props([
    'actions' => null,
    'card' => false,
    'description' => null,
    'header' => null,
    'heading' => null,
    'width' => 'xl',
	'fullWidth' => null,
	'align' => 'left',
])

@php
	$actionsAlign = ($actions) ? $actions->attributes->get('align') : null;
@endphp

<form {{ $attributes->class([
        'space-y-6 pb-2',
        'max-w-xs' => ($width === 'xs' && !$fullWidth),
        'max-w-sm' => ($width === 'sm' && !$fullWidth),
        'max-w-md' => ($width === 'md' && !$fullWidth),
        'max-w-lg' => ($width === 'lg' && !$fullWidth),
        'max-w-xl' => ($width === 'xl' && !$fullWidth),
        'max-w-2xl' => ($width === '2xl' && !$fullWidth),
        'max-w-3xl' => ($width === '3xl' && !$fullWidth),
        'max-w-4xl' => ($width === '4xl' && !$fullWidth),
        'max-w-5xl' => ($width === '5xl' && !$fullWidth),
        'max-w-6xl' => ($width === '6xl' && !$fullWidth),
        'max-w-7xl' => ($width === '7xl' && !$fullWidth),
    ]) }}>
        {{ $header }}

        @if ($heading)
            <div class="space-y-1">
                <x-slate::heading>{{ $heading }}</x-slate::heading>

                {{ $description }}
            </div>
        @endif

        <div class="space-y-6">
            {{ $slot }}
        </div>

        @if ($actions)
            <div {{
				$attributes->class([
					"inline-flex space-x-4 w-full ",
					"justify-end" => ($actionsAlign == 'right'),
					"justify-center" => ($actionsAlign == 'center'),
					" " => ($actionsAlign == 'left' || !$actionsAlign),
				])
			}}>
                {{ $actions }}
            </div>
        @endif
</form>