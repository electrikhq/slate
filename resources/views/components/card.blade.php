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
		"flex flex-col justify-between",
		"bg-white dark:bg-gray-800" => !$attributes->get('transparent'),
		"shadow" => !$attributes->get('transparent') || $attributes->get('shadow'),
		"border border-gray-400 dark:border-gray-900" => $attributes->get('outlined-dark'),
		"border border-gray-300 dark:border-gray-700" => $attributes->get('outlined'),
		"hover:shadow-md hover:border-primary-600" => $attributes->get('hover'),
		"rounded" => $attributes->get('rounded'),

	])
}}>
	@if($header)
	<div {{ 
			$attributes->class([
				"flex items-center justify-between",
				"px-4 py-5 sm:px-6" => ($header || $content),
				"px-4 p-5 pb-0 sm:px-6" => ($header && !$content),
				"px-4 p-5 pb-0 sm:px-6" => ($header && $content && !($attributes->get('outlined-dark') || $attributes->get('outlined'))),
			])
		}}>

		{{ $header }}

		@if($meta)
			<div class="meta">
				{{ $meta }}
			</div>
		@endif

	</div>
	@endif
	@if($content)
	<div {{ 
			$attributes->class([
				"px-4 sm:px-6 py-6",
				"border-t border-gray-300 dark:border-gray-700  " => $attributes->get('outlined') && $header,
				"border-t border-gray-400 dark:border-gray-900  " => $attributes->get('outlined-dark') && $header,
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