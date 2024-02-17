@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'helpText' => null,
	'color' => 'primary',
	'placeholder' => null,
])

@php
    $id ??= $name;
@endphp

<div class="space-y-1">
@if ($label)
	<label
		@if ($id) for="{{ $id }}" @endif
		{{ $attributes->class([
			'block font-medium text-gray-700',
			'text-danger-600' => ($name && $errors->has($name)),
		]) }}"
	>
		{{ $label }}
	</label>
@endif

<div class="mt-1">     

	<textarea
		@if ($id) id="{{ $id }}" @endif
		@if ($name) name="{{ $name }}" @endif
		@if ($placeholder) placeholder="{{ $placeholder }}" @endif
		{{ $attributes->class([
			'shadow-sm mt-1 block w-full border border-gray-300 rounded-md',
			'focus:ring-primary-500 focus:border-primary-500' => ($color == 'primary'),
			'focus:ring-success-500 focus:border-success-500' => ($color == 'success'),
			'focus:ring-warning-500 focus:border-warning-500' => ($color == 'warning'),
			'focus:ring-danger-500 focus:border-danger-500' => ($color == 'danger'),
			'focus:ring-secondary-500 focus:border-secondary-500' => ($color == 'secondary'),
			'focus:ring-info-500 focus:border-info-500' => ($color == 'info'),
			'border-danger-600 ring-danger-600' => ($name && $errors->has($name)),
		]) }}
	></textarea>
</div>

@if ($name && $errors->has($name))
	<p class="mt-1 text-danger-600">{{ $errors->first($name) }}</p>
@endif

@if ($helpText)
	<p class="mt-2 text-gray-500">{{ $helpText }}</p>
@endif
</div>