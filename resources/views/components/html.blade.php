@props([
	'head' => null,
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>{{ env('APP_NAME', '')}}</title>


		@if($head)
			{{ $head }}
		@endif

    </head>
    <body 
		{{ 
			$attributes->class([
				"font-sans antialiased bg-gray-200 dark:bg-gray-800",
				"flex flex-col h-screen",
			])
		}}
	>
		{{ $slot }}


		@if($foot)
			{{ $foot }}
		@endif

    </body>
</html>
