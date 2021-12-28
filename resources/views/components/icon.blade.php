@props([
    'color' => 'primary',
    'icon' => null,
    'type' => 'span',
	'rounded' => null,
	'id' => null,
	'href' => null,
	'target' => null,
	'size' => 'md',
	'transparent' => null
])

@if($type == 'button')
	{!! '<button' !!}
@elseif($type == 'link')
	{!! '<a' !!}
@else	
	{!! '<span' !!}
@endif
		{{ $attributes->class([
			'inline-flex items-center justify-center transition focus:outline-none',
			'text-primary-600 hover:bg-primary-600/5 focus:bg-primary-600/10' => ($color === 'primary' && !$transparent),
			'text-gray-600 hover:bg-gray-600/5 focus:bg-gray-600/10' => ($color === 'secondary' && !$transparent),
			'text-success-600 hover:bg-success-600/5 focus:bg-success-600/10' => ($color === 'success' && !$transparent),
			'text-warning-600 hover:bg-warning-600/5 focus:bg-warning-600/10' => ($color === 'warning' && !$transparent),
			'text-danger-600 hover:bg-danger-600/5 focus:bg-danger-600/10' => ($color === 'danger' && !$transparent),
			'text-info-600 hover:bg-info-600/5 focus:bg-info-600/10' => ($color === 'info' && !$transparent),
			'rounded-full' => ($rounded),
			'rounded-lg' => (!$rounded),
			'w-10 h-10 p-0' => ($size == 'md'),
			'w-12 h-12 p-0' => ($size == 'lg'),
			'w-9 h-9 p-0' => ($size == 'sm'),
			'w-7 h-7 p-0' => ($size == 'xs'),
		]) }}
		@if ($id) href="{{ $id }}" @endif
	>
		<x-dynamic-component 
			:component="$icon" 
			class="
				m-1
			"
		/>

@if($type == 'button')
	{!! '</button>' !!}
@elseif($type == 'link')
	{!! '</a>' !!}
@else
	{!! '</span>' !!}
@endif
