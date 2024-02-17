@props([
	'cols' => 2,
])

<div {{ 
		$attributes->class([
			"grid gap-4",
			"grid-cols-1" => $cols == 1,
			"grid-cols-2" => $cols == 2,
			"grid-cols-3" => $cols == 3,
			"grid-cols-4" => $cols == 4,
			"grid-cols-5" => $cols == 5,
		])
}} >
    {{ $slot }}
</div>