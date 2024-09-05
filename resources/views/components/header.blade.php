@props([
    'color' => 'primary',
    'shadow' => false,
    'sticky' => false,
    'fullWidth' => false,
    'size' => 'md',
])
@php

use Electrik\Slate\SlateUiHelper;

$headerClass = SlateUIHelper::getHeaderClasses($size, $color, $shadow, $fullWidth);


// Merge all classes
$classes = implode(' ', [$headerClass, 'flex items-center justify-between']);

@endphp
<div 
    {{ $attributes->merge(['class' => $classes]) }}
>
	<div class="flex-1 min-w-0">
		@if(isset($title))
			{{ $title }}
		@endif
		@if(isset($meta))
		<div class="mt-2 flex flex-col">
			{{ $meta }}
		</div>
		@endif
	</div>
	<div class="flex space-x-4">
		@if(isset($actions))
			{{ $actions }}
		@endif
	</div>
</div>