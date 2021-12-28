<div class="flex h-screen overflow-hidden">
	
	@if($sidebar)
		{{ $sidebar }}
	@endif

	<div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
		@if($header)
		<div class="mb-2 inline-flex justify-end h-14 items-center px-2">
			{{ $header }}
		</div>
		@endif
		{{ $slot }}
	</div>

</div>