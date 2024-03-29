@props([
	'tag'=>'h1',
	'fontThin' => null,
	'fontRegular' => null,
	'fontMedium' => true,
	'fontBold' => null,
	'fontBlack' => null,
	'uppercase' => null,
])

@if($tag == 'h1')
<h1 {{
	$attributes->class([
		'text-grayy-900 dark:text-stone-300 text-2xl max-w-none',
		'font-thin' => $fontThin,
		'font-regular' => $fontRegular,
		'font-medium' => $fontMedium,
		'font-bold' => $fontBold,
		'font-black' => $fontBlack,
		'uppercase' => $uppercase,
	])
}}>{{ $slot }}</h1>
@endif
@if($tag == 'h2')
<h2 {{
	$attributes->class([
		'text-grayy-900 dark:text-stone-300 text-xl max-w-none',
		'font-thin' => $fontThin,
		'font-regular' => $fontRegular,
		'font-medium' => $fontMedium,
		'font-bold' => $fontBold,
		'font-black' => $fontBlack,
		'uppercase' => $uppercase,

	])
}}>{{ $slot }}</h2>
@endif
@if($tag == 'h3')
<h3 {{
	$attributes->class([
		'text-grayy-900 dark:text-stone-300 text-lg max-w-none',
		'font-thin' => $fontThin,
		'font-regular' => $fontRegular,
		'font-medium' => $fontMedium,
		'font-bold' => $fontBold,
		'font-black' => $fontBlack,
		'uppercase' => $uppercase,

	])
}}>{{ $slot }}</h3>
@endif
@if($tag == 'h4')
<h4 {{
	$attributes->class([
		'text-grayy-900 dark:text-stone-300 text-md max-w-none',
		'font-thin' => $fontThin,
		'font-regular' => $fontRegular,
		'font-medium' => $fontMedium,
		'font-bold' => $fontBold,
		'font-black' => $fontBlack,
		'uppercase' => $uppercase,

	])
}}>{{ $slot }}</h4>
@endif
@if($tag == 'h5')
<h5 {{
	$attributes->class([
		'text-grayy-900 dark:text-stone-300 text-sm max-w-none',
		'font-thin' => $fontThin,
		'font-regular' => $fontRegular,
		'font-medium' => $fontMedium,
		'font-bold' => $fontBold,
		'font-black' => $fontBlack,
		'uppercase' => $uppercase,

	])
}}>{{ $slot }}</h5>
@endif
@if($tag == 'h6')
<h6 {{
	$attributes->class([
		'text-grayy-900 dark:text-stone-300 text-xs max-w-none',
		'font-thin' => $fontThin,
		'font-regular' => $fontRegular,
		'font-medium' => $fontMedium,
		'font-bold' => $fontBold,
		'font-black' => $fontBlack,
		'uppercase' => $uppercase,

	])
}}>{{ $slot }}</h6>
@endif
