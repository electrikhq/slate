@props([
    'type' => 'text',
    'label' => null,
    'name',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'readonly' => false,
    'disabled' => false,
    'helpText' => null,
    'error' => null
])

<div class="space-y-1">
    @if ($label)
		<label
			for="{{ $name }}"
			{{ $attributes->class([
				'block font-medium cursor-pointer text-gray-700 dark:text-gray-500',
				'text-danger-600' => ($name && $errors->has($name)),
			]) }}"
		>
			{{ $label }}
		</label>
	@endif
    <input {{ $attributes->merge([
        'type' => $type,
        'name' => $name,
        'value' => old($name, $value),
        'placeholder' => $placeholder,
        'id' => $name,
        'class' => 'block w-full px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:focus:ring-gray-500 dark:focus:border-gray-500' .
                  ($errors->has($name) ? ' border-red-600' : ' border-gray-300') .
                  ($disabled ? ' bg-gray-100' : '') .
                  ($readonly ? ' bg-gray-50' : '') .
                  ' dark:bg-gray-950 dark:text-white dark:border-gray-600 dark:placeholder-gray-800'
        ]) }}
        {{ $required ? 'required' : '' }}
        {{ $readonly ? 'readonly' : '' }}
        {{ $disabled ? 'disabled' : '' }}
    />
    @if($helpText)
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-800">{{ $helpText }}</p>
    @endif
    @if($error)
        <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
    @endif
</div>
