@props([
	'left'=>null,
	'right' => null,
	'rounded' => null,
])

<div {{ 
		$attributes->class([
			"grid overflow-hidden grid-rows-1 my-4",
			"grid-cols-1 sm:grid-cols-1" => ($attributes->get('cols') == 1),
			"grid-cols-1 sm:grid-cols-3" => ($attributes->get('cols') != 1),
			"shadow-md bg-white rounded-md dark:bg-gray-900 dark:text-white" => !$attributes->get('transparent'),
			'rounded-md' => $rounded
		])
	}}
>

@if($attributes->get('cols') != 1)
	@if($left)
	<div {{ 
		$attributes->class([
			"rounded col-span-1 mx-4 py-4",
			"shadow-md bg-white rounded-md dark:bg-gray-900 px-4 dark:text-white" => !$left->attributes->get('transparent')
		])
	}}
	>
		{{ $left }}	
	</div>
	@endif
	@if($right)
	<div {{ 
		$attributes->class([
			"rounded col-span-2 mx-4 py-4",
			"shadow-md bg-white rounded-md dark:bg-gray-900 px-4 dark:text-white" => !$right->attributes->get('transparent')
		])
	}}
	>
		{{ $right }}	
	</div>
	@endif

@else 
<div {{ 
		$attributes->class([
			"min-w-full min-h-full rounded col-span-1 px-5 py-4 dark:text-white",
		])
	}}
>
	{{ $slot }}
</div>
@endif


</div>