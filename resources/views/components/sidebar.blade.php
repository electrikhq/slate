@props([
	'logo' => null,
])
<div
	x-data="{ 
		sidebarOpen: true,
		toggleSidebar() { 
			this.sidebarOpen = !this.sidebarOpen;
			localStorage.sidebarOpen = this.sidebarOpen;
		} 
	}"
	
	x-init="
		() => {
			console.log(localStorage.sidebarOpen);
			if (localStorage.sidebarOpen == 'true') {
				sidebarOpen = true;
			} else {
				sidebarOpen = false;
			}
		}"

	@toggle-sidebar.window="if(event.detail == 'slate-sidebar') { toggleSidebar(); }"
	:class="{ 'w-72': sidebarOpen === true, 'w-16': sidebarOpen  === false}"

	{{
		$attributes->class([
			"z-40 transform bg-white dark:bg-gray-900 transition-all ease-in-out w-72",
			"flex flex-col overflow-scroll"
		])
	}}
>
	{{ $slot }}
</div>