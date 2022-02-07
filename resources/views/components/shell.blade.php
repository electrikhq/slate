@props([
	'nav' => null,
	'sidebar' => null,
])

<div {{
	$attributes->class([
		"flex flex-1 overflow-hidden",
	])
}}>
	
	@if($sidebar)
		{{ $sidebar }}
	@endif

	<div {{
	$attributes->class([
		"flex flex-1 flex-col",
	])
}}">
		
		<div {{ 
			$attributes->class([
				"flex items-center",
				"shadow-sm" => $attributes->get('shadow'),
				])
			}}
		>
			@if($attributes->get('no-burger-menu') != true)
				<div class="inline-flex justify-end " x-data="{}">
					<x-slate::icon color="gray" icon="carbon-menu" data-target="slate-sidebar" @click="$dispatch('toggle-sidebar', $el.dataset.target)" class="" />
				</div>
			@endif
			
			@if($nav) 
				<div class="inline-flex flex-1 justify-end items-center">
					@if($nav)
						{{ $nav }}
					@endif
				</div>
			@endif

		</div>

		{{ $slot }}

		
	</div>


</div>