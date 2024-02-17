@props([

])
<div {{
		$attributes->class([
			'mt-4 mb-2 inline-flex items-center h-14 mx-4 font-medium dark:text-gray-100 duration-400 transition',
		])
	}}
	x-bind:class="{ 'opacity-100': sidebarOpen === true, 'opacity-0': sidebarOpen  === false}"
>
{{ $slot }}
</div>