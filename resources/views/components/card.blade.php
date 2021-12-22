@props([
	'header' => null,
	'meta' => null,
	'content' => null,
	'actions' => null,
	'align' => 'left',
])
@php
	$actionsAlign = $actions->attributes->get('align')
@endphp
<div 
{{ $attributes->class([
	"shadow overflow-hidden sm:rounded-md bg-white dark:bg-gray-800",
	])
}}
>
@if($header)
  <div class="px-4 py-5 sm:px-6">

	{{ $header }}
    

	@if($meta)
	{{ $meta }}
    
	@endif
  </div>
  @endif
  <div class="px-4 py-5 sm:px-6 border-t border-gray-200 dark:border-gray-700  ">
	  {{ $content }}
    
  </div>

  @if($actions)
  <div 
  	{{
		$attributes->class([
			"inline-flex  w-full px-4 py-5 sm:px-6 border-t bg-gray-100 border-gray-200 dark:border-gray-700 dark:bg-gray-700",
			"justify-end" => ($actionsAlign == 'right'),
			"justify-center" => ($actionsAlign == 'center'),
			" " => ($actionsAlign == 'left' || !$actionsAlign),
		])
	}}
	>
	  {{ $actions }}
	</div>
	@endif

</div>
