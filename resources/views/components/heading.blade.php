@props([
	'tag'=>'h1',
	'fontThin' => null,
	'fontRegular' => null,
	'fontMedium' => null,
	'fontBold' => null,
	'fontBlack' => null,
])

@if($tag == 'h1')
<h1 {{
	$attributes->class([
		'prose dark:prose-invert prose-2xl'
	])
}}>{{ $slot }}</h1>
@endif
@if($tag == 'h2')
<h2 {{
	$attributes->class([
		'prose dark:prose-invert prose-xl'

	])
}}>{{ $slot }}</h2>
@endif
@if($tag == 'h3')
<h3 {{
	$attributes->class([
		'prose dark:prose-invert prose-lg'

	])
}}>{{ $slot }}</h3>
@endif
@if($tag == 'h4')
<h4 {{
	$attributes->class([
		'prose dark:prose-invert prose-base'

	])
}}>{{ $slot }}</h4>
@endif
@if($tag == 'h5')
<h5 {{
	$attributes->class([
		'prose dark:prose-invert prose-sm'

	])
}}>{{ $slot }}</h5>
@endif
@if($tag == 'h6')
<h6 {{
	$attributes->class([
		'prose dark:prose-invert prose-sm'

	])
}}>{{ $slot }}</h6>
@endif
