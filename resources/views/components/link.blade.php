@props([
    'color' => "primary",
	'href' => null,
	'target' => null,
	'id' => null,
])

<a {{ $attributes
		->class([
			'focus:underline focus:outline-none hover:underline hover:outline-none',
			'text-primary-600 hover:text-primary-700' => ($color == "primary"),
			'text-secondary-600 hover:text-secondary-700' => ($color == "secondary"),
			'text-success-600 hover:text-success-700' => ($color == "success"),
			'text-danger-600 hover:text-danger-700' => ($color == "danger"),
			'text-warning-600 hover:text-warning-700' => ($color == "warning"),
			'text-info-600 hover:text-info-700' => ($color == "info"),
		])
	}}

	@if ($id) href="{{ $id }}" @endif
	@if ($href) href="{{ $href }}" @endif
	@if ($target) target="{{ $target }}" @endif
>
	{{ $slot }}
</a>
