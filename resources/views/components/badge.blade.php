@props([
    'color' => "primary",
    'size' => "md",
	'rounded' => null,
	'outlined' => null
])

<span {{ $attributes->class([
    'inline-flex items-center justify-center font-medium',
    'text-primary-800 bg-primary-100 dark:text-primary-900 dark:bg-primary-200' => ($color == 'primary' && !$outlined),
    'text-secondary-800 bg-secondary-100 dark:text-secondary-900 dark:bg-secondary-200' => ($color == 'secondary' && !$outlined),
    'text-danger-800 bg-danger-100 dark:text-danger-900 dark:bg-danger-200' => ($color == 'danger' && !$outlined),
    'text-success-800 bg-success-100 dark:text-success-900 dark:bg-success-200' => ($color == 'success' && !$outlined),
    'text-warning-800 bg-warning-100 dark:text-warning-900 dark:bg-warning-200' => ($color == 'warning' && !$outlined),
    'text-info-800 bg-info-100 dark:text-info-900 dark:bg-info-200' => ($color == 'info' && !$outlined),

	'text-primary-800 border border-primary-800 dark:text-primary-900' => ($color == 'primary' && $outlined),
	'text-secondary-800 border border-secondary-800 dark:text-secondary-900' => ($color == 'secondary' && $outlined),
	'text-danger-800 border border-danger-800 dark:text-danger-900' => ($color == 'danger' && $outlined),
	'text-success-800 border border-success-800 dark:text-success-900' => ($color == 'success' && $outlined),
	'text-warning-800 border border-warning-800 dark:text-warning-900' => ($color == 'warning' && $outlined),
	'text-info-800 border border-info-800 dark:text-info-900' => ($color == 'info' && $outlined),
    'h-5 px-2 text-xs' => ($size == 'xs'),
    'h-6 px-2 text-sm' => $size == 'sm',
    'h-6 px-2 text-md' => $size == 'md',
    'h-7 px-3 text-lg' => ($size == 'lg'),
	'rounded-md' => ($rounded),
]) }}>

{{ $slot }}

</span>
