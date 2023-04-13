@props([
	'color' => null,
	'dismissable' => null,
	'icon' => null,
	'width' => 'md',
	'fullWidth' => null,
	'floating' => null,
	'top' => true,
	'bottom' => null,
	'slim' => null,
	'actions' => null,
	'shadow' => null,
	'rounded' => null,
])

<div

	x-data="{ show: true }"
	x-init="
	() => {
		if(this.show == undefined) this.show = true;
	}"
	x-show="show"

	{{ 
		$attributes->class([
			'relative' => $floating,
			'pointer-events-none',
		])
	}}
>
	<div
		{{ 
			$attributes->class([
				'bg-'.$color.'-600 text-gray-50 dark:bg-'.$color.'-600 dark:text-gray-100 font-medium flex items-center px-2 py-1',
				'max-w-'.$width.' mx-auto' => !$fullWidth || $floating,
				'rounded-md shadow-md z-50 fixed left-1/2 transform -translate-x-1/2' => $floating,
				'shadow-md' => $shadow,
				'rounded-md ' => $rounded,
				'top-6 ' => $floating && $top && !$bottom,
				'bottom-6 ' => $floating && $bottom,
				'py-6' => !$slim,
				'pointer-events-none',
			])
		}}
	>

		@if($icon)
			<div class="shrink-0 mr-1">
				<x-slate::icon :icon="$icon" color="white" size="sm" />
			</div>
		@endif

		<div class="flex-1 mx-1">
			{{ $slot }}
		</div>

		@if($actions)
            <div class="mx-2 pointer-events-auto">
				{{ $actions }}
            </div>
			@endif

		@if($dismissable)
			<div class="flex-shrink-0 pointer-events-auto">
				<button type="button"
					x-on:click="show = false"
					x-transition
					{{ $attributes->class([
						'flex rounded-md focus:outline-none transition ease-in-out duration-150',
						'hover:bg-primary-500 focus:bg-primary-500' => ($color == "primary"),
						'hover:bg-secondary-500 focus:bg-secondary-500' => ($color == "secondary"),
						'hover:bg-warning-500 focus:bg-warning-500' => ($color == "warning"),
						'hover:bg-success-500 focus:bg-success-500' => ($color == "success"),
						'hover:bg-danger-500 focus:bg-danger-500' => ($color == "danger"),
						'hover:bg-info-500 focus:bg-info-500' => ($color == "info"),
					]) }}
				>
					<svg class="h-6 w-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M6 18L18 6M6 6l12 12" />
					</svg>
				</button>
			</div>
		@endif


	</div>
</div>