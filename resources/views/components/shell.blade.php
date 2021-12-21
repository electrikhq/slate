@props([
	'id' => null,
	'sidebar' => null,
	'brand' => null,
	'link' => null
])

<div 
	@if ($id) {{ $id }} @endif
>

	<div class="flex flex-col md:flex-row ">

		<aside 

			{{
				$attributes->class([
					'w-full md:w-64 md:min-h-screen bg-gray-200 dark:bg-gray-800',
				])
			}}
		
		
		 x-data="{ isOpen: false }"
		>
		<div class="flex items-center justify-between p-4 h-16 bg-white dark:bg-gray-900">
			@if('brand')
			<x-slate::brand
				:brand="$brand"
				icon="carbon-dashboard"

			/>
			@endif
					
			<div class="flex md:hidden">
				<button type="button" @click="isOpen = !isOpen" class="">
					<x-carbon-menu class="w-7 h-7 text-gray-900 hover:text-gray-700 focus:outline-none focus:text-gray-700" />
				</button>
			</div>
		</div>
			<div class="px-2 py-6 md:block" :class="isOpen? 'block': 'hidden'">
				{!! $sidebar !!}
			</div>
		</aside>

		<div class="w-full md:flex-1">
			<nav 
				{{ 
					$attributes->class([
						'hidden md:flex justify-between items-center p-4 h-16 bg-white dark:bg-gray-900',
					])
				}}
			>

				<x-slate::navigation>
					<x-slot name="left">
						{{ $right }}
					</x-slot>
					<x-slot name="right">
						{{ $left }}
					</x-slot>
				</x-slate::navigation>
			</nav>
			<main class="bg-gray-200">

				{{ $slot }}

			</main>
		</div>
		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			{{ csrf_field() }}
		</form>
	</div>
</div>