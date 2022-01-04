@props([
    'id' => null,
    'name' => null,
    'type' => 'text',
	'color' => 'primary',
	'value' => null,
	'size' => 'sm',
	'outlined' => null,
	'fullWidth' => null,
	'thick' => null,
])

@php
    $id ??= $name;
@endphp
<button 
	type="{{ $type ??= 'button' }}" 
	{{ $attributes
		->class([
			"uppercase shadow-md justify-center py-2 px-4 border border-transparent font-medium rounded-md text-white focus:outline-none focus:ring-2 focus:ring-offset-2 tracking-widest",
			"inline-flex" => (!$fullWidth),
			"inline-block w-full" => ($fullWidth),
			'bg-primary-600 hover:bg-primary-700 focus:bg-primary-700' => ($color == "primary" && !$outlined),
			'bg-secondary-600 hover:bg-secondary-700 focus:bg-secondary-700' => ($color == "secondary" && !$outlined),
			'bg-success-600 hover:bg-success-700 focus:bg-success-700' => ($color == "success" && !$outlined),
			'bg-danger-600 hover:bg-danger-700 focus:bg-danger-700' => ($color == "danger" && !$outlined),
			'bg-warning-600 hover:bg-warning-700 focus:bg-warning-700' => ($color == "warning" && !$outlined),
			'bg-info-600 hover:bg-info-700 focus:bg-info-700' => ($color == "info" && !$outlined),
			'bg-transparent border border-primary-600 hover:border-primary-900 focus:border-primary-700 text-primary-700 hover:text-primary-900' => ($color == "primary" && $outlined),
			'bg-transparent border border-secondary-600 hover:border-secondary-900 focus:border-secondary-700 text-secondary-700 hover:text-secondary-900' => ($color == "secondary" && $outlined),
			'bg-transparent border border-success-600 hover:border-success-900 focus:border-success-700 text-success-700 hover:text-success-900' => ($color == "success" && $outlined),
			'bg-transparent border border-danger-600 hover:border-danger-900 focus:border-danger-700 text-danger-700 hover:text-danger-900' => ($color == "danger" && $outlined),
			'bg-transparent border border-warning-600 hover:border-warning-900 focus:border-warning-700 text-warning-700 hover:text-warning-900' => ($color == "warning" && $outlined),
			'bg-transparent border border-info-600 hover:border-info-900 focus:border-info-700 text-info-700 hover:text-info-900' => ($color == "info" && $outlined),

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
			'border-2' => ($thick),
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
