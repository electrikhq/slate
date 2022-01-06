@props([
	'nav' => null,
	'sidebar' => null,
])
<div class="flex flex-1 overflow-hidden">
	
	@if($sidebar)
		{{ $sidebar }}
	@endif

	<div class="flex flex-1 flex-col">

		<div {{ 
				$attributes->class([
					"flex items-center py-2.5 px-4",
					"bg-white" => $attributes->get('transparent'),
					"shadow-sm" => $attributes->get('shadow'),
				])
			}}
		>
			@if($sidebar)
				<div class="inline-flex justify-end " x-data="{}">
					<x-slate::icon color="gray" icon="carbon-menu" data-target="slate-sidebar" @click="$dispatch('toggle-sidebar', $el.dataset.target)" class="" />
				</div>
			@endif
			<div class="inline-flex flex-1 justify-end items-center">
				@if($nav)
					{{ $nav }}
				@endif
			</div>
		</div>
      

			{{ $slot }}

		
	</div>

</div>