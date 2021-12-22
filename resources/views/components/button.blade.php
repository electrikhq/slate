@props([
    'id' => null,
    'name' => null,
    'type' => 'text',
	'color' => 'primary',
	'value' => null,
	'size' => 'md',
])

@php
    $id ??= $name;
@endphp
<button 
	type="{{ $type ??= 'button' }}" 
	{{ $attributes
		->class([
			"inline-flex uppercase shadow-md justify-center py-2 px-4 border border-transparent font-medium rounded-md text-white focus:outline-none focus:ring-2 focus:ring-offset-2",
			'bg-primary-600 hover:bg-primary-700 focus:bg-primary-700' => ($color == "primary"),
			'bg-secondary-600 hover:bg-secondary-700 focus:bg-secondary-700' => ($color == "secondary"),
			'bg-success-600 hover:bg-success-700 focus:bg-success-700' => ($color == "success"),
			'bg-danger-600 hover:bg-danger-700 focus:bg-danger-700' => ($color == "danger"),
			'bg-warning-600 hover:bg-warning-700 focus:bg-warning-700' => ($color == "warning"),
			'bg-info-600 hover:bg-info-700 focus:bg-info-700' => ($color == "info"),
			'text-xs' => ($size == 'xs'),
			'text-sm' => ($size == 'sm'),
			'text-md' => ($size == 'md'),
			'text-xl' => ($size == 'xl'),
			'text-2xl' => ($size == '2xl'),
			'text-3xl' => ($size == '3xl'),
			'text-4xl' => ($size == '4xl'),
			'text-5xl' => ($size == '5xl'),
			'text-6xl' => ($size == '6xl'),
			'text-7xl' => ($size == '7xl'),
			])
	}}

	@if ($id) href="{{ $id }}" @endif
>	

	@if(!$value)
		{{ $slot }}
	@else 
		{{ $value }}
	@endif
</button>
