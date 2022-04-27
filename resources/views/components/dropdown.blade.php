<div class="inline-flex">
	<div x-on:click.away="dropdownMenu = false" x-data="{ dropdownMenu: false }" class="relative inline-block text-left">
		<div>
			<button x-on:click="dropdownMenu = ! dropdownMenu" class="inline-flex justify-center items-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
				{{ $title }}
				<x-slate::icon icon="carbon-caret-down" size="xs" />
			</button>
		</div>

		<div x-show="dropdownMenu" class="z-10 origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none">
			@if(isset($slot)) {{ $slot }} @endif
		</div>
	</div>
</div>