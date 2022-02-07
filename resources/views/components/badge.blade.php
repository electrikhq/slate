@props([
    'color' => "primary",
    'size' => "sm",
	'rounded' => null,
	'outlined' => null
])

<span {{ $attributes->class([
	"font-medium mx-1 px-2.5 py-0.5 leading-0",

	"text-primary-800 dark:text-primary-800" => ($color == "primary"),
	"text-secondary-800 dark:text-secondary-800" => ($color == "secondary"),
	"text-success-800 dark:text-success-800" => ($color == "success"),
	"text-warning-800 dark:text-warning-800" => ($color == "warning"),
	"text-danger-800 dark:text-danger-800" => ($color == "danger"),
	"text-info-800 dark:text-info-800" => ($color == "info"),
	
	"bg-primary-100 dark:bg-primary-200" => ($color == "primary" && !$outlined),
	"bg-secondary-100 dark:bg-secondary-200" => ($color == "secondary" && !$outlined),
	"bg-success-100 dark:bg-success-200" => ($color == "success" && !$outlined),
	"bg-warning-100 dark:bg-warning-200" => ($color == "warning" && !$outlined),
	"bg-danger-100 dark:bg-danger-200" => ($color == "danger" && !$outlined),
	"bg-info-100 dark:bg-info-200" => ($color == "info" && !$outlined),
	
	"border border-primary-100 dark:border-primary-200" => ($color == "primary" && $outlined),
	"border border-secondary-100 dark:border-secondary-200" => ($color == "secondary" && $outlined),
	"border border-success-100 dark:border-success-200" => ($color == "success" && $outlined),
	"border border-warning-100 dark:border-warning-200" => ($color == "warning" && $outlined),
	"border border-danger-100 dark:border-danger-200" => ($color == "danger" && $outlined),
	"border border-info-100 dark:border-info-200" => ($color == "info" && $outlined),

    'text-xs' => ($size == 'xs'),
    'text-sm' => $size == 'sm',
    'text-md' => $size == 'md',
    'text-lg' => ($size == 'lg'),
    'text-xl' => ($size == 'xl'),
    'text-2xl' => ($size == '2xl'),
    'text-3xl' => ($size == '3xl'),

	'rounded' => ($rounded),
	
]) }}>

{{ $slot }}

</span>
