@props([
	'head' => null,
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">


		@if($head)
			{{ $head }}
		@endif

        <title>{{ env('APP_NAME', '')}}</title>

		<link rel="stylesheet" href="{{ asset('css/app.css') }}">

		<script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body 
		{{ $attributes->class([
			"bg-gray-200 min-h-screen font-sans antialiased",
			])
		}}
	>
		{{ $slot }}

    </body>
</html>
