@props([
	'heading' => null,
	'meta' => null,
	'actions' => null,
	'transparent' => null,
	'fullWidth' => null,
	'shadow' => null,
])
<div 
	{{ 
		$attributes->class([
			"flex items-center justify-between py-6 px-4 mx-auto",
			"bg-white dark:bg-black text-gray-900 dark:text-gray-100 " => !$transparent,
			"mx-4 rounded-md" => !$fullWidth,
			"mx-0 w-full" => $fullWidth,
			"shadow-sm" => $shadow,
		])
	}}
>
	<div class="flex-1 min-w-0">
		@if($heading)
		<h2 class="text-2xl font-bold leading-7 sm:text-3xl sm:truncate">
			{{ $heading }}
		</h2>
		@endif
		@if($meta)
		<div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
			{{ $meta }}
		</div>
		@endif
	</div>
	<div class="mt-5 flex lg:mt-0 lg:ml-4">
		{{ $actions }}
	</div>
</div>