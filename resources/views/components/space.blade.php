@props([
	'size' => 'sm',
])

<div {{ 
		$attributes->class([
			"inline-flex",
			"h-6" => $size == 'xs',
			"h-12" => $size == 'sm',
			"h-24" => $size == 'md',
			"h-36" => $size == 'lg',
			"h-48" => $size == 'xl',
			"h-60" => $size == '2xl',
			"h-72" => $size == '3xl',
			"h-84" => $size == '4xl',
			"h-96" => $size == '5xl',
		])
	}}
>

</div>