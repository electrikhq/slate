@props([
	'title' => null,
	'meta' => null,
	'actions' => null,
	'transparent' => null,
	'fullWidth' => null,
	'shadow' => null,
	'color' => null,
])
<div 
	{{ 
		$attributes->class([
			"flex items-center justify-between py-6 px-4 mx-auto",
			"bg-gray-200 dark:bg-gray-900 text-gray-900 dark:text-gray-100" => !$color,
			"bg-primary-200 dark:bg-gray-900 text-gray-900 dark:text-gray-100 " => $color == 'primary',
			"bg-secondary-200 dark:bg-gray-900 text-gray-900 dark:text-gray-100 " => $color == 'secondary',
			"bg-success-200 dark:bg-gray-900 text-gray-900 dark:text-gray-100 " => $color == 'success',
			"bg-warning-200 dark:bg-gray-900 text-gray-900 dark:text-gray-100 " => $color == 'warning',
			"bg-danger-200 dark:bg-gray-900 text-gray-900 dark:text-gray-100 " => $color == 'danger',
			"bg-info-200 dark:bg-gray-900 text-gray-900 dark:text-gray-100 " => $color == 'info',
			"mx-4 rounded-md" => !$fullWidth,
			"mx-0 w-full" => $fullWidth,
			"shadow-sm" => $shadow,
		])
	}}
>
	<div class="flex-1 min-w-0">
		@if($title)
			{{ $title }}
		@endif
		@if($meta)
		<div class="mt-2 flex flex-col">
			{{ $meta }}
		</div>
		@endif
	</div>
	<div class="mt-5 flex space-x-4">
		{{ $actions }}
	</div>
</div>