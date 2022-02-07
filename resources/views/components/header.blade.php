@props([

])
<div 
	{{ 
		$attributes->class([
			"flex items-center justify-between py-6 px-4 mx-auto",
			"bg-gray-200 dark:bg-gray-900 text-gray-900 dark:text-gray-100" => !$attributes->get('color'),
			"bg-primary-200 dark:bg-gray-900 text-gray-900 dark:text-gray-100 " => $attributes->get('color') == 'primary',
			"bg-secondary-200 dark:bg-gray-900 text-gray-900 dark:text-gray-100 " => $attributes->get('color') == 'secondary',
			"bg-success-200 dark:bg-gray-900 text-gray-900 dark:text-gray-100 " => $attributes->get('color') == 'success',
			"bg-warning-200 dark:bg-gray-900 text-gray-900 dark:text-gray-100 " => $attributes->get('color') == 'warning',
			"bg-danger-200 dark:bg-gray-900 text-gray-900 dark:text-gray-100 " => $attributes->get('color') == 'danger',
			"bg-info-200 dark:bg-gray-900 text-gray-900 dark:text-gray-100 " => $attributes->get('color') == 'info',
			"bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 " => $attributes->get('color') == 'white',
			"mx-4 rounded-md" => !$attributes->get('full-width'),
			"mx-0 w-full" => $attributes->get('full-width'),
			"shadow-sm" => $attributes->get('shadow'),
		])
	}}
>
	<div class="flex-1 min-w-0">
		@if(isset($title))
			{{ $title }}
		@endif
		@if(isset($meta))
		<div class="mt-2 flex flex-col">
			{{ $meta }}
		</div>
		@endif
	</div>
	<div class="mt-5 flex space-x-4">
		@if(isset($actions))
			{{ $actions }}
		@endif
	</div>
</div>