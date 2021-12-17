@props([
    'color' => "priamry",
    'size' => null,
	'rounded' => null,
])

<span {{ $attributes->class([
    'inline-flex items-center justify-center font-medium tracking-tight',
    'text-primary-600 bg-primary-50' => ($color == 'primary'),
    'text-secondary-600 bg-secondary-50' => ($color == 'secondary'),
    'text-danger-600 bg-danger-50' => ($color == 'danger'),
    'text-success-600 bg-success-50' => ($color == 'success'),
    'text-warning-600 bg-warning-50' => ($color == 'warning'),
    'h-5 px-2 text-xs' => ($size == 'xs'),
    'h-6 px-2 text-sm' => $size == 'sm',
    'h-7 px-3 text-lg' => ($size == 'lg'),
	'rounded-full' => (!$rounded),
	'rounded-lg' => ($rounded),
]) }}>

{{ $slot }}

</span>
