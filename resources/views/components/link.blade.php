@props([
    'color' => "primary",
	'href' => null,
	'target' => null,
	'id' => null,
])

<a {{ $attributes
		->class([
			'focus:underline focus:outline-none hover:underline hover:outline-none',
			'text-primary-600 hover:text-primary-900' => ($color == "primary"),
			'text-secondary-600 hover:text-secondary-900' => ($color == "secondary"),
			'text-success-600 hover:text-success-900' => ($color == "success"),
			'text-danger-600 hover:text-danger-900' => ($color == "danger"),
			'text-warning-600 hover:text-warning-900' => ($color == "warning"),
			'text-info-600 hover:text-info-900' => ($color == "info"),
		])
	}}

	@if ($id) id="{{ $id }}" @endif
	@if ($href) href="{{ $href }}" @endif
	@if ($target) target="{{ $target }}" @endif
>
	{{ $slot }}
</a>
