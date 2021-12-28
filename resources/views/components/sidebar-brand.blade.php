@props([
	'logo',
	'link' => null,
	'brand',
])
<div {{
		$attributes->class([
			'rounded-sm mb-0.5 first:mb-5 last:mb-0 inline-flex items-center h-10',
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