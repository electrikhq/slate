@props([
	'color' => 'primary',
	'name' => null,
	'id' => null,
])

@php
	$id ?? $id = $name
@endphp
<div class="inline-flex ">
<x-dynamic-component component="carbon-awake" class="w-6 h-6 mr-1 text-gray-800 dark:text-gray-100"/>
<span 
	x-data="{ 
		darkMode: false, 
		toggle() { 
			this.darkMode = !this.darkMode;

			if(!this.darkMode) localStorage.theme = 'light'
			else localStorage.theme = 'dark';

			if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
				document.documentElement.classList.add('dark')
			} else {
				document.documentElement.classList.remove('dark')
			}



		} 
	}"
	x-init="
		() => {
			// On page load or when changing themes, best to add inline in `head` to avoid FOUC
			if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
				document.documentElement.classList.add('dark')
			} else {
				document.documentElement.classList.remove('dark')
			}
		}

	"
	{{ 
		$attributes->class([
			'relative inline-block flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:shadow-outline',
			'bg-primary-600' => ($color == 'primary'),
			'bg-secondary-600' => ($color == 'secondary'),
			'bg-success-600' => ($color == 'success'),
			'bg-warning-600' => ($color == 'warning'),
			'bg-danger-600' => ($color == 'danger'),
			'bg-info-600' => ($color == 'info'),
		])
	}}

	:class="{ 'bg-gray-200': !darkMode, 'bg-indigo-600': darkMode }"

	role="checkbox" tabindex="0" @click="toggle()" @keydown.space.prevent="toggle()"
	:aria-checked="darkMode.toString()"
	
	>
	
	<span aria-hidden="true" 
		{{ 
			$attributes->class([
				'relative inline-block h-5 w-5 rounded-full bg-white shadow transform transition ease-in-out duration-200',
			])
		}}
		:class="{ 'translate-x-5': darkMode, 'translate-x-0': !darkMode }"
		>
		<span :class="{ 'opacity-0 ease-out duration-100': darkMode, 'opacity-100 ease-in duration-200': !darkMode }"
			class="absolute inset-0 h-full w-full flex items-center justify-center transition-opacity">
		</span>
		<span :class="{ 'opacity-100 ease-in duration-200': darkMode, 'opacity-0 ease-out duration-100': !darkMode }"
			class="absolute inset-0 h-full w-full flex items-center justify-center transition-opacity">
		</span>
	</span>

	@if(($id && $name))
	<input 
		type="hidden" :darkMode="darkMode" 
		@if ($id) id="{{ $id }}" @endif
		@if ($name) name="{{ $name }}" @endif
	/>
	@endif
</span>
<x-dynamic-component component="carbon-asleep" class="w-6 h-6 ml-1 text-gray-800 dark:text-gray-100"/>
</div>