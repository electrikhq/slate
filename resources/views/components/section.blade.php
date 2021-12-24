<div class="grid overflow-hidden grid-cols-3 grid-rows-1 gap-2 my-4">
	@if($left)
	<div {{ 
		$attributes->class([
			"min-w-full min-h-full rounded col-span-1 px-5 py-4",
			"shadow-md bg-white rounded-md dark:bg-gray-900" => !$left->attributes->get('transparent')
		])
	}}
	>
		{{ $left }}	
	</div>
	@endif
	@if($right)
	<div {{ 
		$attributes->class([
			"min-w-full min-h-full rounded col-span-2 px-5 py-4",
			"shadow-md bg-white rounded-md dark:bg-gray-900" => !$right->attributes->get('transparent')
		])
	}}
	>
		{{ $right }}	
	</div>
	@endif
</div>