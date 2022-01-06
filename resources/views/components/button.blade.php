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
	'inverted' => null,
	'link' => null,
])

@php
    $id ??= $name;
@endphp

@if($link)
<a
	href="{{ $link }}"
@else
<button 
	type="{{ $type ??= 'button' }}" 
@endif

	{{ $attributes
		->class([
			"uppercase shadow-md justify-center py-2 px-4 border font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 tracking-widest",
			"inline-flex" => (!$fullWidth),
			"inline-block w-full" => ($fullWidth),
			'text-white border-primary-600 bg-primary-600 hover:bg-primary-700 focus:bg-primary-700' => ($color == "primary" && !$outlined && !$inverted),
			'text-white border-secondary-600 bg-secondary-600 hover:bg-secondary-700 focus:bg-secondary-700' => ($color == "secondary" && !$outlined && !$inverted),
			'text-white border-success-600 bg-success-600 hover:bg-success-700 focus:bg-success-700' => ($color == "success" && !$outlined && !$inverted),
			'text-white border-danger-600 bg-danger-600 hover:bg-danger-700 focus:bg-danger-700' => ($color == "danger" && !$outlined && !$inverted),
			'text-white border-warning-600 bg-warning-600 hover:bg-warning-700 focus:bg-warning-700' => ($color == "warning" && !$outlined && !$inverted),
			'text-white border-info-600 bg-info-600 hover:bg-info-700 focus:bg-info-700' => ($color == "info" && !$outlined && !$inverted),
			
			'border-transparent bg-gray-50 text-primary-600 hover:text-white hover:bg-primary-800 focus:bg-primary-700' => ($color == "primary" && $inverted),
			'border-transparent bg-gray-50 text-secondary-600 hover:text-white hover:bg-secondary-800 focus:bg-secondary-700' => ($color == "secondary" && $inverted),
			'border-transparent bg-gray-50 text-success-600 hover:text-white hover:bg-success-800 focus:bg-success-700' => ($color == "success" && $inverted),
			'border-transparent bg-gray-50 text-warning-600 hover:text-white hover:bg-warning-800 focus:bg-warning-700' => ($color == "warning" && $inverted),
			'border-transparent bg-gray-50 text-danger-600 hover:text-white hover:bg-danger-800 focus:bg-danger-700' => ($color == "danger" && $inverted),
			'border-transparent bg-gray-50 text-info-600 hover:text-white hover:bg-info-800 focus:bg-info-700' => ($color == "info" && $inverted),
			
			
			'bg-transparent border border-primary-600 hover:border-primary-900 focus:border-primary-700 text-primary-700 hover:text-primary-900' => ($color == "primary" && $outlined && !$inverted),
			'bg-transparent border border-secondary-600 hover:border-secondary-900 focus:border-secondary-700 text-secondary-700 hover:text-secondary-900' => ($color == "secondary" && $outlined && !$inverted),
			'bg-transparent border border-success-600 hover:border-success-900 focus:border-success-700 text-success-700 hover:text-success-900' => ($color == "success" && $outlined && !$inverted),
			'bg-transparent border border-danger-600 hover:border-danger-900 focus:border-danger-700 text-danger-700 hover:text-danger-900' => ($color == "danger" && $outlined && !$inverted),
			'bg-transparent border border-warning-600 hover:border-warning-900 focus:border-warning-700 text-warning-700 hover:text-warning-900' => ($color == "warning" && $outlined && !$inverted),
			'bg-transparent border border-info-600 hover:border-info-900 focus:border-info-700 text-info-700 hover:text-info-900' => ($color == "info" && $outlined && !$inverted),

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
	@if($link)
</a>
@else
</button>
@endif

