<div class="flex h-screen overflow-hidden">
	
	@if($sidebar)
		{{ $sidebar }}
	@endif

	<div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
		@if($header)
		<div class="mb-2 inline-flex h-14 px-2">
			<div class="inline-flex justify-end items-center" x-data="{}">
				<x-slate::icon color="gray" icon="carbon-menu" data-target="slate-sidebar" @click="$dispatch('toggle-sidebar', $el.dataset.target)" class="shrink-0" />
			</div>
			<div class="inline-flex flex-1 justify-end items-center">
				{{ $header }}
			</div>
		</div>
		@endif
		{{ $slot }}
	</div>

</div>