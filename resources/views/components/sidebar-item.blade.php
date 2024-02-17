@props([
	'color' => null,
	'iconColor' => null,
	'icon' => null,
	'iconSize' => 'sm',
	'link' => null,
	'label' => null,
	'labelColor' => null,
])

@php
	if(!$iconColor) $iconColor = $color;
@endphp
<div 

{{
		$attributes->class([
			'rounded-sm mb-0.5 last:mb-0 inline-flex items-center py-1 font-medium',
			'ml-2' => !$icon,
			'text-primary-600 hover:text-primary-900' => ($color == "primary"),
			'text-secondary-600 hover:text-secondary-900' => ($color == "secondary"),
			'text-success-600 hover:text-success-900' => ($color == "success"),
			'text-danger-600 hover:text-danger-900' => ($color == "danger"),
			'text-warning-600 hover:text-warning-900' => ($color == "warning"),
			'text-info-600 hover:text-info-900' => ($color == "info"),
			
			'text-primary-800 dark:text-primary-900' => ($attributes->get('active') && $color == 'primary'),
			'text-secondary-800 dark:text-secondary-900' => ($attributes->get('active') && $color == 'secondary'),
			'text-success-800 dark:text-success-900' => ($attributes->get('active') && $color == 'success'),
			'text-warning-800 dark:text-warning-900' => ($attributes->get('active') && $color == 'warning'),
			'text-danger-800 dark:text-danger-900' => ($attributes->get('active') && $color == 'danger'),
			'text-info-800 dark:text-info-900' => ($attributes->get('active') && $color == 'info'),	

			'text-primary-800 dark:text-primary-900' => ($attributes->get('active') && !$color),
		])
	}}
>

@if($link)
<a {{
		$attributes->class([
			'rounded-sm mb-0.5 last:mb-0 inline-flex items-center w-full font-medium',
		])
	}}
	href="{{$link}}"
>
@else
<div {{
		$attributes->class([
			'rounded-sm mb-0.5 last:mb-0 inline-flex items-center w-full ',
		])
	}}
>
@endif


@if($icon)
<x-slate::icon
	:icon="$icon"
	:color="($iconColor) ? $iconColor : ''"
	:size="$iconSize"
	class="shrink-0 ml-2 mr-0.5"
/>
@endif

<span {{ $attributes->class([
		"flex-1 ml-1 duration-200",
		])
	}}
	x-bind:class="{ 'opacity-100': sidebarOpen === true, 'opacity-0': sidebarOpen  === false}"
>
	{{ $slot }}
</span>


@if($label)
	<span
		{{
			$attributes->class([
				"inline-flex leading-0 p-0.5 pb-0 px-1 ml-1 mr-0 tracking-wide text-sm font-medium duration-200",
			])
		}}
		x-bind:class="{ 'opacity-100': sidebarOpen === true, 'opacity-0': sidebarOpen  === false}"

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