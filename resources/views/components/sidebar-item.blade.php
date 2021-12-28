@props([
	'icon' => null,
	'iconColor' => null,
	'iconSize' => 'sm',
	'link' => null,
	'label' => null,
	'labelColor' => null,
])

<div {{
		$attributes->class([
			'rounded-sm mb-0.5 last:mb-0 inline-flex items-center hover:bg-gray-200 mx-2 py-1 font-medium',
		])
	}}
>

@if($link)
<a {{
		$attributes->class([
			'min-h-10 rounded-sm mb-0.5 last:mb-0 inline-flex items-center w-full min-h-full h-10',
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

<span class="flex-1 ml-1 duration-200"
	:class="{ 'opacity-100': sidebarOpen === true, 'opacity-0': sidebarOpen  === false}"
>
	{{ $slot }}
</span>


@if($label)
	<span
		{{
			$attributes->class([
				"inline-flex leading-0 p-0.5 pb-0 px-1 ml-1 mr-2 tracking-wide text-sm font-medium text-gray-500 bg-gray-300 rounded-md duration-200",
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

@if($link)
</a>
@else
</div>
@endif

</div>