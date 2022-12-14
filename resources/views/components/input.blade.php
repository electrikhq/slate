@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'type' => 'text',
    'helpText' => null,
	'color' => 'primary',
	'addon' => null,
	'addonPosition' => 'after',
	'placeholder' => null,
	'autocomplete' => null,
	'size' => 'md',
])

@php
    $id ??= $name;
@endphp

<div {{ $attributes->class([
		"space-y-1",
	])
}}>
	@if ($label)
		<label
			@if ($id) for="{{ $id }}" @endif
			{{ $attributes->class([
				'block font-medium text-gray-700  dark:text-gray-300',
				'text-danger-600' => ($name && $errors->has($name)),
			]) }}"
		>
			{{ $label }}
		</label>
	@endif

	<div class="mt-1 flex rounded-md shadow-sm">
	@if($addon && $addonPosition == 'before')
		<span {{
			$attributes->class([
				'inline-flex items-center px-3 rounded-l-md border border-r-0 text-gray-500 bg-gray-50 border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400',
				"text-xs" => $size == "xs",
				"text-md" => $size == "md",
				"text-lg" => $size == "lg",
				"text-xl" => $size == "xl",
				"text-2xl" => $size == "2xl",
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
		@if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
		
		{{ $attributes->class([
			'flex-1 block w-full rounded-md',
			'text-gray-900 dark:text-gray-300',
			'border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white' => (!$attributes->get('disabled')),
			'border border-gray-300 bg-gray-100 text-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-600 dark:text-gray-600' => ($attributes->get('disabled')),
			'rounded-none rounded-r-md' => ( $addon && $addonPosition == 'before' ),
			'rounded-none rounded-l-md' => ( $addon && $addonPosition == 'after' ),
			'focus:ring-primary-500 focus:border-primary-500' => ($color == 'primary'),
			'focus:ring-success-500 focus:border-success-500' => ($color == 'success'),
			'focus:ring-warning-500 focus:border-warning-500' => ($color == 'warning'),
			'focus:ring-danger-500 focus:border-danger-500' => ($color == 'danger'),
			'focus:ring-secondary-500 focus:border-secondary-500' => ($color == 'secondary'),
			'focus:ring-info-500 focus:border-info-500' => ($color == 'info'),
			'border-danger-600 ring-danger-600' => ($name && $errors->has($name)),
			"text-xs" => $size == "xs",
			"text-md" => $size == "md",
			"text-lg" => $size == "lg",
			"text-xl" => $size == "xl",
			"text-2xl" => $size == "2xl",
		]) }}
	/>

	@if($addon && $addonPosition == 'after')
		<span {{
			$attributes->class([
				'inline-flex items-center px-3 rounded-r-md border border-l-0 text-gray-500 bg-gray-50 border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400',
				"text-xs" => $size == "xs",
				"text-md" => $size == "md",
				"text-lg" => $size == "lg",
				"text-xl" => $size == "xl",
				"text-2xl" => $size == "2xl",
			])
		}}
		>
		{{ $addon }}
		</span>
	@endif

	</div>

	@if ($name && $errors->has($name))
		<p class="mt-1 text-danger-600">{{ $errors->first($name) }}</p>
	@endif

	@if ($helpText)
		<p class="mt-2 text-gray-500 dark:text-gray-400">{{ $helpText }}</p>
	@endif
</div>
