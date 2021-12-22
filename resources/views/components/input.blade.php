@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'type' => 'text',
    'helpText' => null,
	'color' => 'primary',
	'addon' => null,
	'placeholder' => null,
])

@php
    $id ??= $name;
@endphp

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

<div class="mt-1 flex rounded-md shadow-sm">
@if($addon)
	<span {{
		$attributes->class([
			'inline-flex items-center px-3 rounded-l-md border border-r-0 text-gray-500 bg-gray-50 border-gray-300',
		])
	}}
	>
	{{ $addon }}
	</span>
@endif          

<input
	@if ($id) id="{{ $id }}" @endif
	@if ($name) name="{{ $name }}" @endif
	@if ($type) type="{{ $type }}" @endif
	@if ($placeholder) placeholder="{{ $placeholder }}" @endif
	
	{{ $attributes->class([
		'flex-1 block w-full rounded-md',
		'text-gray-900 dark:text-gray-300',
		'border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white',
		'rounded-none rounded-r-md' => ( $addon ),
		'focus:ring-primary-500 focus:border-primary-500' => ($color == 'primary'),
		'focus:ring-success-500 focus:border-success-500' => ($color == 'success'),
		'focus:ring-warning-500 focus:border-warning-500' => ($color == 'warning'),
		'focus:ring-danger-500 focus:border-danger-500' => ($color == 'danger'),
		'focus:ring-secondary-500 focus:border-secondary-500' => ($color == 'secondary'),
		'focus:ring-info-500 focus:border-info-500' => ($color == 'info'),
		'border-danger-600 ring-danger-600' => ($name && $errors->has($name)),
	]) }}
/>
</div>

@if ($name && $errors->has($name))
	<p class="mt-1 text-danger-600">{{ $errors->first($name) }}</p>
@endif

@if ($helpText)
	<p class="mt-2 text-gray-500">{{ $helpText }}</p>
@endif