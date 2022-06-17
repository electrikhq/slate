@props([
	'header' => null,
	'meta' => null,
	'content' => null,
	'actions' => null,
	'align' => 'left',
])

@php
	$actionsAlign = ($actions) ? $actions->attributes->get('align') : null;
@endphp

<div {{ 
	$attributes->class([
		"overflow-hidden",
		"bg-white dark:bg-gray-800" => !$attributes->get('transparent'),
		"shadow" => !$attributes->get('transparent') || $attributes->get('shadow'),
		"border border-gray-400 dark:border-gray-900" => $attributes->get('outlined'),
		"hover:shadow-md hover:border-primary-600" => $attributes->get('hover'),
		"rounded" => $attributes->get('rounded'),

	])
}}>
	@if($header)
	<div class="px-4 py-5 sm:px-6 flex items-center justify-between">

		{{ $header }}

		@if($meta)
			{{ $meta }}
		@endif

	</div>
	@endif
	@if($content)
	<div {{ 
			$attributes->class([
				"px-4 py-5 sm:px-6",
				"border-t border-gray-200 dark:border-gray-700  " => !$attributes->get('outlined'),
			])
		}}>
		{{ $content }}
	</div>
	@endif

	@if($actions)
	<div {{
		$attributes->class([
			"inline-flex  w-full px-4 py-5 sm:px-6 ",
			"justify-end" => ($actionsAlign == 'right'),
			"justify-center" => ($actionsAlign == 'center'),
			" " => ($actionsAlign == 'left' || !$actionsAlign),
			"border-t bg-gray-100 border-gray-200 dark:border-gray-700 dark:bg-gray-700" => !$attributes->get('transparent'),
		])
	}}>
		{{ $actions }}
	</div>
	@endif

</div>