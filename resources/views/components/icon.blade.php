@props([
    'color' => 'primary',
    'icon' => null,
    'type' => 'span',
	'rounded' => null,
	'id' => null,
	'link' => null,
	'target' => null,
	'size' => 'md',
	'transparent' => null,
	'target' => null
])

@if($type == 'button')
	{!! '<button' !!}
@elseif($type == 'link' || isset($link))
	{!! '<a' !!}
@else	
	{!! '<span' !!}
@endif
		{{ $attributes->class([
			'inline-flex items-center justify-center transition focus:outline-none underline-none',
			'text-primary-600 dark:text-primary-500 focus:bg-primary-600/10' => ($color === 'primary' && !$transparent),
			'text-gray-600 dark:text-gray-500 focus:bg-gray-600/10' => ($color === 'secondary' && !$transparent),
			'text-success-600 dark:text-success-500 focus:bg-success-600/10' => ($color === 'success' && !$transparent),
			'text-warning-600 dark:text-warning-500 focus:bg-warning-600/10' => ($color === 'warning' && !$transparent),
			'text-danger-600 dark:text-danger-500 focus:bg-danger-600/10' => ($color === 'danger' && !$transparent),
			'text-info-600 dark:text-info-500 focus:bg-info-600/10' => ($color === 'info' && !$transparent),
			'text-white:bg-white/10' => ($color === 'white' && !$transparent),
			'text-black:bg-black/10' => ($color === 'black' && !$transparent) || ($color == null),
			'text-gray-600 focus:bg-gray-600/10 dark focus:bg-gray-900/10' => ($color === 'gray' && !$transparent),
			'rounded-full' => ($rounded),
			'rounded-lg' => (!$rounded),
			'w-10 h-10 p-0' => ($size == 'md'),
			'w-12 h-12 p-0' => ($size == 'lg'),
			'w-14 h-14 p-0' => ($size == 'xl'),
			'w-9 h-9 p-0' => ($size == 'sm'),
			'w-7 h-7 p-0' => ($size == 'xs'),
		]) }}
		@if ($id) id="{{ $id }}" @endif
		@if ($link) href="{{ $link }}" @endif
		@if ($target) target="{{ $target }}" @endif
	>
		<x-dynamic-component 
			:component="$icon" 
			class="
				m-1
				underline-none
				shrink-0
			"
		/>

@if($type == 'button')
	{!! '</button>' !!}
@elseif($type == 'link' || isset($link))
	{!! '</a>' !!}
@else
	{!! '</span>' !!}
@endif
