@props([
    'color' => "priamry",
    'size' => null,
	'rounded' => null,
])

<span {{ $attributes->class([
    'inline-flex items-center justify-center font-medium text-sm font-medium text-gray-700',
    'text-primary-800 bg-primary-100' => ($color == 'primary'),
    'text-secondary-800 bg-secondary-100' => ($color == 'secondary'),
    'text-danger-800 bg-danger-100' => ($color == 'danger'),
    'text-success-800 bg-success-100' => ($color == 'success'),
    'text-warning-800 bg-warning-100' => ($color == 'warning'),
    'h-5 px-2 text-xs' => ($size == 'xs'),
    'h-6 px-2 text-sm' => $size == 'sm',
    'h-7 px-3 text-lg' => ($size == 'lg'),
	'rounded-full' => (!$rounded),
	'rounded-lg' => ($rounded),
]) }}>

{{ $slot }}

</span>
