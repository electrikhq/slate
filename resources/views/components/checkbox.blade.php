@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'type' => 'text',
    'helpText' => null,
	'color' => 'primary',
	'addon' => null,
	'placeholder' => null,
	'autocomplete' => null,
])

@php
    $id ??= $name;
@endphp

<div class="space-y-1">
	<div class="flex items-center">
	<input
		@if ($id) id="{{ $id }}" @endif
		@if ($name) name="{{ $name }}" @endif
		type="checkbox"
		{{ $attributes->class([
            'transition duration-75 rounded shadow-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-500',
            'border-gray-300' => (! $name || ! $errors->has($name)),
            'border-danger-300 ring-danger-500' => ($name && $errors->has($name)),
		]) }}
	/>
	@if ($label)
		<label
			@if ($id) for="{{ $id }}" @endif
			{{ $attributes->class([
				'block font-medium text-gray-700  dark:text-gray-300 ml-2',
				'text-danger-600' => ($name && $errors->has($name)),
			]) }}"
		>
			{{ $label }}
		</label>
	@endif

</div>

	@if ($name && $errors->has($name))
		<p class="mt-1 text-danger-600">{{ $errors->first($name) }}</p>
	@endif

	@if ($helpText)
		<p class="mt-2 text-gray-500 dark:text-gray-400">{{ $helpText }}</p>
	@endif
</div>