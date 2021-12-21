@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'type' => 'text',
    'helpText' => null,
	'color' => 'primary'
])

@php
    $id ??= $name;
@endphp

@if ($label)
	<label
		@if ($id) for="{{ $id }}" @endif
		{{ $attributes->class([
			'block text-sm font-medium text-gray-700',
			'text-danger-600' => ($name && $errors->has($name)),
		]) }}"
	>
		{{ $label }}
	</label>
@endif

<input
	@if ($id) id="{{ $id }}" @endif
	@if ($name) name="{{ $name }}" @endif
	@if ($type) type="{{ $type }}" @endif
	{{ $attributes->class([
		'mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md',
		'focus:ring-primary-500 focus:border-primary-500' => ($color == 'primary'),
		'focus:ring-success-500 focus:border-success-500' => ($color == 'success'),
		'focus:ring-warning-500 focus:border-warning-500' => ($color == 'warning'),
		'focus:ring-danger-500 focus:border-danger-500' => ($color == 'danger'),
		'focus:ring-secondary-500 focus:border-secondary-500' => ($color == 'secondary'),
		'focus:ring-info-500 focus:border-info-500' => ($color == 'info'),
		'border-danger-600 ring-danger-600' => ($name && $errors->has($name)),
	]) }}
/>

@if ($name && $errors->has($name))
	<p class="text-sm mt-1 text-danger-600">{{ $errors->first($name) }}</p>
@endif

@if ($helpText)
	<p class="mt-2 text-sm text-gray-500">{{ $helpText }}</p>
@endif