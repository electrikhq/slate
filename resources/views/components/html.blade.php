@props([
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		
		@if($attributes->get('title'))
			<title>{{ $title }}</title>
		@else
			<title>{{ env('APP_NAME', '')}}</title>
		@endif

		@if(isset($head))
			{{ $head }}
		@endif

    </head>
    <body 
		{{ 
			$attributes->class([
				"font-sans antialiased",
				"flex flex-col h-screen",
				"bg-gray-200 dark:bg-gray-800",
				"bg-white dark:bg-gray-800" => $attributes->get('bg-white'),
			])
		}}
	>
		{{ $slot }}

		@if(isset($foot))
			{{ $foot }}
		@endif

    </body>
</html>
