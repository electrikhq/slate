@props([
    'id' => null,
    'name' => null,
    'type' => 'text',
	'color' => 'primary',
	'value' => null,
	'size' => 'md',
	'outlined' => null,
	'fullWidth' => null,
	'thick' => null,
	'inverted' => null,
	'link' => null,
	'shadow' => null,
	'disabled' => null,
	'icon' => null,
    'iconPosition' => 'before',
])

@php
    $id ??= $name;
@endphp

@if($link)
<a
	href="{{ $link }}"
@else
<button 
	type="{{ $type ??= 'button' }}" 
@endif

	@if ($id) id="{{ $id }}" @endif
	@if ($disabled) disabled="disabled" @endif

	{{ $attributes
		->class([
			"uppercase justify-center border font-medium rounded focus:outline-none focus:ring-2 focus:ring-offset-2 tracking-widest no-underline p-0",
			
			"inline-flex items-center" => (!$fullWidth),
			"inline-block w-full" => ($fullWidth),

			'text-white hover:text-white border-primary-600 bg-primary-600 hover:bg-primary-700 focus:bg-primary-700' => ($color == "primary" && !$outlined && !$inverted && !$disabled),
			'text-white hover:text-white border-secondary-600 bg-secondary-600 hover:bg-secondary-700 focus:bg-secondary-700' => ($color == "secondary" && !$outlined && !$inverted && !$disabled),
			'text-white hover:text-white border-success-600 bg-success-600 hover:bg-success-700 focus:bg-success-700' => ($color == "success" && !$outlined && !$inverted && !$disabled),
			'text-white hover:text-white border-danger-600 bg-danger-600 hover:bg-danger-700 focus:bg-danger-700' => ($color == "danger" && !$outlined && !$inverted && !$disabled),
			'text-white hover:text-white border-warning-600 bg-warning-600 hover:bg-warning-700 focus:bg-warning-700' => ($color == "warning" && !$outlined && !$inverted && !$disabled),
			'text-white hover:text-white border-info-600 bg-info-600 hover:bg-info-700 focus:bg-info-700' => ($color == "info" && !$outlined && !$inverted && !$disabled),
			
			'bg-primary-100 text-primary-400/70 border-primary-100' => ($color == "primary" && !$inverted && !$outlined && $disabled),
			'bg-secondary-100 text-secondary-400/70 border-secondary-100' => ($color == "secondary" && !$inverted && !$outlined && $disabled),
			'bg-success-100 text-success-400/70 border-success-100' => ($color == "success" && !$inverted && !$outlined && $disabled),
			'bg-danger-100 text-danger-400/70 border-danger-100' => ($color == "danger" && !$inverted && !$outlined && $disabled),
			'bg-warning-100 text-warning-400/70 border-warning-100' => ($color == "warning" && !$inverted && !$outlined && $disabled),
			'bg-info-100 text-info-400/70 border-info-100' => ($color == "info" && !$inverted && !$outlined && $disabled),
			
			'border-transparent bg-gray-50 text-primary-600 hover:text-white hover:bg-primary-800 focus:bg-primary-700' => ($color == "primary" && $inverted && !$disabled),
			'border-transparent bg-gray-50 text-secondary-600 hover:text-white hover:bg-secondary-800 focus:bg-secondary-700' => ($color == "secondary" && $inverted && !$disabled),
			'border-transparent bg-gray-50 text-success-600 hover:text-white hover:bg-success-800 focus:bg-success-700' => ($color == "success" && $inverted && !$disabled),
			'border-transparent bg-gray-50 text-warning-600 hover:text-white hover:bg-warning-800 focus:bg-warning-700' => ($color == "warning" && $inverted && !$disabled),
			'border-transparent bg-gray-50 text-danger-600 hover:text-white hover:bg-danger-800 focus:bg-danger-700' => ($color == "danger" && $inverted && !$disabled),
			'border-transparent bg-gray-50 text-info-600 hover:text-white hover:bg-info-800 focus:bg-info-700' => ($color == "info" && $inverted && !$disabled),
			
			'bg-primary-100 text-primary-400/70 border-primary-100' => ($color == "primary" && $inverted && !$outlined && $disabled),
			'bg-secondary-100 text-secondary-400/70 border-secondary-100' => ($color == "secondary" && $inverted && !$outlined && $disabled),
			'bg-success-100 text-success-400/70 border-success-100' => ($color == "success" && $inverted && !$outlined && $disabled),
			'bg-danger-100 text-danger-400/70 border-danger-100' => ($color == "danger" && $inverted && !$outlined && $disabled),
			'bg-warning-100 text-warning-400/70 border-warning-100' => ($color == "warning" && $inverted && !$outlined && $disabled),
			'bg-info-100 text-info-400/70 border-info-100' => ($color == "info" && $inverted && !$outlined && $disabled),
			
			'bg-transparent border border-primary-600 hover:border-primary-900 focus:border-primary-700 text-primary-700 hover:text-primary-900' => ($color == "primary" && $outlined && !$inverted),
			'bg-transparent border border-secondary-600 hover:border-secondary-900 focus:border-secondary-700 text-secondary-700 hover:text-secondary-900' => ($color == "secondary" && $outlined && !$inverted),
			'bg-transparent border border-success-600 hover:border-success-900 focus:border-success-700 text-success-700 hover:text-success-900' => ($color == "success" && $outlined && !$inverted),
			'bg-transparent border border-danger-600 hover:border-danger-900 focus:border-danger-700 text-danger-700 hover:text-danger-900' => ($color == "danger" && $outlined && !$inverted),
			'bg-transparent border border-warning-600 hover:border-warning-900 focus:border-warning-700 text-warning-700 hover:text-warning-900' => ($color == "warning" && $outlined && !$inverted),
			'bg-transparent border border-info-600 hover:border-info-900 focus:border-info-700 text-info-700 hover:text-info-900' => ($color == "info" && $outlined && !$inverted),

			'bg-primary-100 text-primary-400/70 hover:text-primary-400/70 border-primary-100 hover:border-primary-100' => ($color == "primary" && !$inverted && $outlined && $disabled),
			'bg-secondary-100 text-secondary-400/70 hover:text-secondary-400/70 border-secondary-100 hover:border-secondary-100' => ($color == "secondary" && !$inverted && $outlined && $disabled),
			'bg-success-100 text-success-400/70 hover:text-success-400/70 border-success-100 hover:border-success-100' => ($color == "success" && !$inverted && $outlined && $disabled),
			'bg-danger-100 text-danger-400/70 hover:text-danger-400/70 border-danger-100 hover:border-danger-100' => ($color == "danger" && !$inverted && $outlined && $disabled),
			'bg-warning-100 text-warning-400/70 hover:text-warning-400/70 border-warning-100 hover:border-warning-100' => ($color == "warning" && !$inverted && $outlined && $disabled),
			'bg-info-100 text-info-400/70 hover:text-info-400/70 border-info-100 hover:border-info-100' => ($color == "info" && !$inverted && $outlined && $disabled),
			

			'text-xs py-0.5 px-1.5' => ($size == 'xs' && !$icon),
			'text-xs py-1 px-2' => ($size == 'sm' && !$icon),
			'text-sm py-1.5 px-3' => ($size == 'md' && !$icon),
			'text-lg py-1.5 px-4' => ($size == 'lg' && !$icon),
			'text-lg py-2 px-6' => ($size == 'xl' && !$icon),
			'text-xl py-2.5 px-8' => ($size == '2xl' && !$icon),
			'text-2xl py-2.5 px-9' => ($size == '3xl' && !$icon),
			
			'text-xs py-0.25 px-0.75' => ($size == 'xs' && $icon),
			'text-xs py-0.5 px-1' => ($size == 'sm' && $icon),
			'text-sm py-1 px-3' => ($size == 'md' && $icon),
			'text-lg py-0.75 px-2' => ($size == 'lg' && $icon),
			'text-lg py-1 px-3' => ($size == 'xl' && $icon),
			'text-xl py-1.25 px-4' => ($size == '2xl' && $icon),
			'text-2xl py-1.25 px-4.5' => ($size == '3xl' && $icon),

			'border-2' => ($thick),
			'shadow' => $shadow,

			])
	}}
>	


		@if ($icon && $iconPosition === 'before')
            <x-slate::icon :icon="$icon" size="xs" :color="(!$outlined) ? 'white' : '$color'" class="mr-1"/>
        @endif


	@if(!$value)
		{{ $slot }}
	@else 
		{{ $value }}
	@endif

	@if ($icon && $iconPosition === 'after')
		<x-slate::icon :icon="$icon" size="xs" :color="(!$outlined) ? 'white' : '$color'" class="ml-1" />
	@endif


	@if($link)
</a>
@else
</button>
@endif

