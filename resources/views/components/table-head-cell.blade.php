@props([
])

<th {{ 
		$attributes->class([
			"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider",
		]) 
	}}
>
    {{ $slot }}
</th>