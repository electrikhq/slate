@props([
	'logo',
	'link' => null,
	'brand',
])
<div {{
		$attributes->class([
			'mb-2 inline-flex items-center h-14',
		])
	}}
>

@if($link)
<a {{
		$attributes->class([
			'rounded-sm mb-0.5 last:mb-0 inline-flex items-center w-full ',
		])
	}}
	href="{{$link}}"
>
@else
<div {{
		$attributes->class([
			'rounded-sm mb-0.5 last:mb-0 inline-flex items-center w-full ',
		])
	}}
>
@endif
{{ $brand }}
@if($link)
</a>
@else
</div>
@endif

</div>