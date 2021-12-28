<div class="flex h-screen overflow-hidden">
	
	@if($sidebar)
		{{ $sidebar }}
	@endif

	<div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
		<div class="flex" x-data="{}">
			<x-slate::icon icon="carbon-menu" data-target="slate-sidebar" @click="$dispatch('toggle-sidebar', $el.dataset.target)" class="shrink-0 text-gray-600" />
		</div>
		{{ $slot }}
	</div>

</div>