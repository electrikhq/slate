@props([
	'icon' => null,
	'iconColor' => null,
	'iconSize' => null,
	'link' => null,
	'label' => null,
	'labelColor' => null,
])

<div {{
		$attributes->class([
			'flex items-center py-1 hover:bg-gray-300 h-12 min-h-full rounded-md',
		])
	}}
>
@if($icon)
	<x-slate::icon
		:icon="$icon"
		:color="$iconColor"
		:size="$iconSize" 
		class="mx-1"
	/>
@endif
@if($link)
	<a 
		{{
			$attributes->class([
				'flex flex-1 font-medium text-md mx-1',
			])
		}}
		:href="$link"
	 >
	{{ $slot }}
	</a>
@endif

@if(!$link)
	<div
		{{
			$attributes->class([
				'flex flex-1 font-medium text-md mx-1',
			])
		}}
	 >
	{{ $slot }}
	</div>
@endif
@if($label)
	<span
		{{
			$attributes->class([
				"inline-flex leading-0 p-0.5 pb-0 px-1 ml-1 mr-2 tracking-wide text-sm font-medium text-gray-500 bg-gray-300 rounded-md",
				"text-primary" => $labelColor == 'primary',
				"text-secondary" => $labelColor == 'secondary',
				"text-success" => $labelColor == 'success',
				"text-warning" => $labelColor == 'warning',
				"text-danger" => $labelColor == 'danger',
				"text-info" => $labelColor == 'info',
			])
		}}
	>
	{{ $label }}
	</span>
@endif

</div>