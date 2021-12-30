@props([
	'logo',
	'link' => null,
])
<div {{
		$attributes->class([
			'inline-flex items-center h-14',
		])
	}}
>

@if($link)
<a {{
		$attributes->class([
			'mb-0.5 last:mb-0 inline-flex ',
		])
	}}
	href="{{$link}}"
>
@else
<div {{
		$attributes->class([
			'mb-0.5 last:mb-0 inline-flex ',
		])
	}}
>
@endif

@if($expanded)
<div class="inline-flex px-2 h-12 items-center"
	:class="{ 'opacity-100': sidebarOpen === true, 'hidden opacity-0': sidebarOpen  === false}"
>
{{ $expanded }}
</div>
@endif

@if($collapsed)
<div class="inline-flex px-2 h-12 items-center"
	:class="{ 'hidden opacity-0': sidebarOpen === true, 'opacity-100': sidebarOpen  === false}"
>
{{ $collapsed }}
</div>
@endif

@if($link)
</a>
@else
</div>
@endif

</div>