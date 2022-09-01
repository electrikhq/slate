@props([
	'dismissable' => false,
	'color' => null,
	'icon' => null,
	'fullWidth' => null,
])
@php
	$color ??= 'primary';
	$icon ??= 'carbon-warning';
@endphp

<div x-data="{ show: true }" x-show="show" 
	{{ 
		$attributes->class([
			"flex bg-".$color."-100 p-4 items-start",
			"rounded-lg " => !$fullWidth,
		])
	}}
	role="alert">
	<div class="shrink-0">
		<x-slate::icon :icon="$icon" :color="$color" size="xs"></x-slate::icon>
	</div>
	<div class="ml-3 text-sm font-medium text-{{$color}}-700 pt-0.5">
		{{ $slot }}
	</div>
    @if($dismissable)
	<button @click="show = false" type="button" class="ml-auto -mx-1.5 -my-1.5 bg-{{ $color }}-100 text-{{ $color }}-500 rounded-lg focus:ring-2 focus:ring-{{ $color }}-400 p-1.5 hover:bg-{{ $color }}-200 inline-flex h-8 w-8" data-collapse-toggle="alert-3" aria-label="Close">
		<span class="sr-only">Dismiss</span>
		<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
		</svg>
	</button>
    @endif
</div>
