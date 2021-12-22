@props([
    'color' => "priamry",
    'size' => null,
	'rounded' => null,
	'outlined' => null
])

<span {{ $attributes->class([
    'inline-flex items-center justify-center font-medium text-sm font-medium text-gray-700',
    'text-primary-800 bg-primary-100' => ($color == 'primary' && !$outlined),
    'text-secondary-800 bg-secondary-100' => ($color == 'secondary' && !$outlined),
    'text-danger-800 bg-danger-100' => ($color == 'danger' && !$outlined),
    'text-success-800 bg-success-100' => ($color == 'success' && !$outlined),
    'text-warning-800 bg-warning-100' => ($color == 'warning' && !$outlined),
    'text-info-800 bg-info-100' => ($color == 'info' && !$outlined),

	'text-primary-800 border border-primary-800' => ($color == 'primary' && $outlined),
	'text-secondary-800 border border-secondary-800' => ($color == 'secondary' && $outlined),
	'text-danger-800 border border-danger-800' => ($color == 'danger' && $outlined),
	'text-success-800 border border-success-800' => ($color == 'success' && $outlined),
	'text-warning-800 border border-warning-800' => ($color == 'warning' && $outlined),
	'text-info-800 border border-info-800' => ($color == 'info' && $outlined),
    'h-5 px-2 text-xs' => ($size == 'xs'),
    'h-6 px-2 text-sm' => $size == 'sm',
    'h-7 px-3 text-lg' => ($size == 'lg'),
	'rounded-full' => ($rounded),
	'rounded-lg' => (!$rounded),
]) }}>

{{ $slot }}

</span>
