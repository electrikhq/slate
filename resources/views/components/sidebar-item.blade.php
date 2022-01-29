@props([
	'color' => null,
	'iconColor' => null,
	'icon' => null,
	'iconSize' => 'sm',
	'link' => null,
	'label' => null,
	'labelColor' => null,
])

<div {{
		$attributes->class([
			'rounded-sm mb-0.5 last:mb-0 inline-flex items-center mx-2 py-1 font-medium',
			'text-primary-600 hover:text-primary-900' => ($color == "primary"),
			'text-secondary-600 hover:text-secondary-900' => ($color == "secondary"),
			'text-success-600 hover:text-success-900' => ($color == "success"),
			'text-danger-600 hover:text-danger-900' => ($color == "danger"),
			'text-warning-600 hover:text-warning-900' => ($color == "warning"),
			'text-info-600 hover:text-info-900' => ($color == "info"),
			
			'text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-800' => ($attributes->get('active') && !$color),
			
			'bg-primary-200 dark:bg-primary-800' => ($attributes->get('active') && $color == 'primary'),
			'bg-secondary-200 dark:bg-secondary-800' => ($attributes->get('active') && $color == 'secondary'),
			'bg-success-200 dark:bg-success-800' => ($attributes->get('active') && $color == 'success'),
			'bg-warning-200 dark:bg-warning-800' => ($attributes->get('active') && $color == 'warning'),
			'bg-danger-200 dark:bg-danger-800' => ($attributes->get('active') && $color == 'danger'),
			'bg-info-200 dark:bg-info-800' => ($attributes->get('active') && $color == 'info'),	
		])
	}}
>

@if($link)
<a {{
		$attributes->class([
			'min-h-10 rounded-sm mb-0.5 last:mb-0 inline-flex items-center w-full min-h-full h-10 font-medium dark:text-gray-100',
		])
	}}
	href="{{$link}}"
>
@else
<div {{
		$attributes->class([
			'min-h-10 rounded-sm mb-0.5 last:mb-0 inline-flex items-center w-full min-h-full h-10',
		])
	}}
>
@endif


@if($icon)
<x-slate::icon
	:icon="$icon"
	:color="$iconColor"
	:size="$iconSize"
	class="shrink-0 mx-1.5"
/>
@endif

<span {{ $attributes->class([
		"flex-1 ml-1 duration-200",
		])
	}}
	:class="{ 'opacity-100': sidebarOpen === true, 'opacity-0': sidebarOpen  === false}"
>
	{{ $slot }}
</span>


@if($label)
	<span
		{{
			$attributes->class([
				"inline-flex leading-0 p-0.5 pb-0 px-1 ml-1 mr-2 tracking-wide text-sm font-medium duration-200",
			])
		}}
		:class="{ 'opacity-100': sidebarOpen === true, 'opacity-0': sidebarOpen  === false}"

	>
	<x-slate::badge :color="$labelColor">
		{{ $label}}
	</x-slate::badge>
	</span>
@endif

@if($link)
</a>
@else
</div>
@endif

</div>