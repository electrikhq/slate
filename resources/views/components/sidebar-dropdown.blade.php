@props([
	'title' => null,
	'icon' => null,
	'iconColor' => null,
	'iconSize' => 'sm',
	'link' => null,
	'label' => null,
	'labelColor' => null,
])

<div
	x-data="{ expanded: {!! ($attributes->get('active')) ? 'true' : 'false' !!} }"
	@click="expanded = ! expanded" 
	{{
		$attributes->class([
			'rounded-sm mb-0.5 last:mb-0 block mx-2 py-1 font-medium dark:text-gray-100',
		])
	}}
>
	<div class="flex items-center">
		@if($icon)
		<x-slate::icon
			:icon="$icon"
			:color="$iconColor"
			:size="$iconSize"
			class="shrink-0 mx-1.5"
		/>
		@endif

		<span class="flex-1 ml-1 duration-200"
			:class="{ 'opacity-100': sidebarOpen === true, 'opacity-0': sidebarOpen  === false}"
		>
			{{ $title }}
		</span>

		@if($label)
			<span
				{{
					$attributes->class([
						"inline-flex leading-0 p-0.5 pb-0 px-1 ml-1 mr-2 tracking-wide text-sm font-medium text-gray-500 dark:text-gray-100 bg-gray-300 dark:bg-gray-700 rounded-md duration-200",
						"text-primary" => $labelColor == 'primary',
						"text-secondary" => $labelColor == 'secondary',
						"text-success" => $labelColor == 'success',
						"text-warning" => $labelColor == 'warning',
						"text-danger" => $labelColor == 'danger',
						"text-info" => $labelColor == 'info',
					])
				}}
				:class="{ 'opacity-100': sidebarOpen === true, 'opacity-0': sidebarOpen  === false}"

			>
			{{ $label }}
			</span>
		@endif
		<span :class="{ 'hidden': expanded === false}">
			<x-slate::icon size="xs" icon="carbon-caret-down" transparent></x-slate::icon>
		</span>
		<span :class="{ 'hidden': expanded === true }">
			<x-slate::icon size="xs" icon="carbon-caret-right" transparent></x-slate::icon>
		</span>
	</div>
	<div  x-show="expanded" x-collapse class="flex-col flex">
		{{ $slot }}
	</div>

</div>