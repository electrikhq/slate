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
		'text-gray-900 dark:text-gray-100 text-3xl',
		'font-thin' => $fontThin,
		'font-regular' => $fontRegular,
		'font-medium' => $fontMedium,
		'font-bold' => $fontBold,
		'font-black' => $fontBlack,

	])
}}>{{ $slot }}</h1>
@endif
@if($tag == 'h2')
<h2 {{
	$attributes->class([
		'text-gray-900 dark:text-gray-100 text-2xl',
		'font-thin' => $fontThin,
		'font-regular' => $fontRegular,
		'font-medium' => $fontMedium,
		'font-bold' => $fontBold,
		'font-black' => $fontBlack,

	])
}}>{{ $slot }}</h2>
@endif
@if($tag == 'h3')
<h3 {{
	$attributes->class([
		'text-gray-900 dark:text-gray-100 text-xl',
		'font-thin' => $fontThin,
		'font-regular' => $fontRegular,
		'font-medium' => $fontMedium,
		'font-bold' => $fontBold,
		'font-black' => $fontBlack,

	])
}}>{{ $slot }}</h3>
@endif
@if($tag == 'h4')
<h4 {{
	$attributes->class([
		'text-gray-900 dark:text-gray-100 text-lg',
		'font-thin' => $fontThin,
		'font-regular' => $fontRegular,
		'font-medium' => $fontMedium,
		'font-bold' => $fontBold,
		'font-black' => $fontBlack,

	])
}}>{{ $slot }}</h4>
@endif
@if($tag == 'h5')
<h5 {{
	$attributes->class([
		'text-gray-900 dark:text-gray-100 text-md',
		'font-thin' => $fontThin,
		'font-regular' => $fontRegular,
		'font-medium' => $fontMedium,
		'font-bold' => $fontBold,
		'font-black' => $fontBlack,

	])
}}>{{ $slot }}</h5>
@endif
@if($tag == 'h6')
<h6 {{
	$attributes->class([
		'text-gray-900 dark:text-gray-100 text-sm',
		'font-thin' => $fontThin,
		'font-regular' => $fontRegular,
		'font-medium' => $fontMedium,
		'font-bold' => $fontBold,
		'font-black' => $fontBlack,

	])
}}>{{ $slot }}</h6>
@endif
