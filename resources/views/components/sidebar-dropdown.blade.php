@props([
	'title' => null,
	'icon' => null,
	'color' => null,
	'iconColor' => null,
	'iconSize' => 'sm',
	'link' => null,
	'label' => null,
	'labelColor' => null,
])

<div
	x-data="{ 
		expanded: {!! ($attributes->get('active')) ? 'true' : 'false' !!},
	}"
	x-init="
		() => {
			if(this.sidebarOpen == undefined) this.sidebarOpen = true;
		}
	"
	x-on:click="expanded = ! expanded" 
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

		<span 
		{{ 
			$attributes->class([
				'flex-1 ml-1 duration-200',
				'font-thin' => $attributes->get('title-thin'),
				'font-medium' => $attributes->get('title-medium'),
				'font-regular' => $attributes->get('title-regular'),
				'font-bold' => $attributes->get('title-bold'),
				'text-primary-600 hover:text-primary-900' => ($color == "primary"),
				'text-secondary-600 hover:text-secondary-900' => ($color == "secondary"),
				'text-success-600 hover:text-success-900' => ($color == "success"),
				'text-danger-600 hover:text-danger-900' => ($color == "danger"),
				'text-warning-600 hover:text-warning-900' => ($color == "warning"),
				'text-info-600 hover:text-info-900' => ($color == "info"),
				'bg-primary-200 dark:bg-primary-800' => ($attributes->get('active') && $color == 'primary'),
				'bg-secondary-200 dark:bg-secondary-800' => ($attributes->get('active') && $color == 'secondary'),
				'bg-success-200 dark:bg-success-800' => ($attributes->get('active') && $color == 'success'),
				'bg-warning-200 dark:bg-warning-800' => ($attributes->get('active') && $color == 'warning'),
				'bg-danger-200 dark:bg-danger-800' => ($attributes->get('active') && $color == 'danger'),
				'bg-info-200 dark:bg-info-800' => ($attributes->get('active') && $color == 'info'),	
		]) }}
			x-bind:class="{ 'opacity-100': (sidebarOpen || null) === true, 'opacity-0': (sidebarOpen || null)  === false}"
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
				x-bind:class="{ 'opacity-100': sidebarOpen === true, 'opacity-0': sidebarOpen  === false}"

			>
			{{ $label }}
			</span>
		@endif
		<span x-bind:class="{ 'hidden': expanded === false}">
			<x-slate::icon size="xs" icon="carbon-caret-down" transparent></x-slate::icon>
		</span>
		<span x-bind:class="{ 'hidden': expanded === true }">
			<x-slate::icon size="xs" icon="carbon-caret-right" transparent></x-slate::icon>
		</span>
	</div>
	<div  x-show="expanded" x-collapse class="flex-col flex">
		{{ $slot }}
	</div>

</div>