@props([

])
<div {{
		$attributes->class([
			'mx-4 my-2 duration-400 transition border-b',
		])
	}}
	:class="{ 'opacity-100': sidebarOpen === true, 'opacity-0': sidebarOpen  === false}"
>
{{ $slot }}
</div>