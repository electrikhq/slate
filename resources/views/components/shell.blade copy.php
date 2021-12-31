@props([
	'nav' => null,
])
<div class="flex flex-1 overflow-hidden">
	
	@if($sidebar)
		{{ $sidebar }}
	@endif

	<div class="flex flex-1 flex-col">
		@if($sidebar)
		<div class="flex items-center py-2.5 px-4">
			<div class="inline-flex justify-end " x-data="{}">
				<x-slate::icon color="gray" icon="carbon-menu" data-target="slate-sidebar" @click="$dispatch('toggle-sidebar', $el.dataset.target)" class="" />
			</div>
			<div class="inline-flex flex-1 justify-end items-center">
				@if($nav)
					{{ $nav }}
				@endif
			</div>
		</div>
		@endif
		@if($nav && !$sidebar)
		<div class="flex items-center py-2.5 px-4">
			<div class="inline-flex justify-end " x-data="{}">
				<x-slate::icon color="gray" icon="carbon-menu" data-target="slate-sidebar" @click="$dispatch('toggle-sidebar', $el.dataset.target)" class="" />
			</div>
			<div class="inline-flex flex-1 justify-end items-center">
				{{ $nav }}
			</div>
		</div>
		@endif

		<div class="flex flex-1 overflow-y-auto">

			{{ $slot }}

		</div>
		
	</div>

</div>