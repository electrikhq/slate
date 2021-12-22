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
			class="w-full md:w-64 md:min-h-screen bg-white dark:bg-gray-800 shadow-md	"
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
					<x-carbon-menu class="w-7 h-7 focus:outline-none focus:text-gray-700 text-gray-900 dark:text-gray-100" />
				</button>
			</div>
		</div>
			<div class="px-2 py-6 md:block" :class="isOpen? 'block': 'hidden'">
				{!! $sidebar !!}
			</div>
		</aside>

		<div class="w-full md:flex-1">
			<nav class="hidden md:flex justify-between items-center p-4 h-16 bg-white dark:bg-gray-900">

				<x-slate::navigation>
					<x-slot name="left">
						{{ $right }}
					</x-slot>
					<x-slot name="right">
						{{ $left }}
					</x-slot>
				</x-slate::navigation>
			</nav>
			<main>

				{{ $slot }}

			</main>
		</div>
		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			{{ csrf_field() }}
		</form>
	</div>
</div>