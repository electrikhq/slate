@props([
	'brand',
	'link' => null,
	'icon' => null,
	'image' => null
])


@if($link)
<a href="#" class="flex items-center">
@else
<span class="flex items-center">
@endif
	
	@if($icon)
		<x-dynamic-component :component="$icon" class="h-7 w-7 text-gray-800 dark:text-gray-100" />
	@elseif($image)
		<img src="{{ $image }}" class="h-7 w-7 rounded-full"  />
	@endif

	<span class="text-gray-800 dark:text-gray-100 text-lg font-semibold mx-2">
		{{ $brand }}
	</span>

@if($link)
</a>
@else
</span>
@endif


