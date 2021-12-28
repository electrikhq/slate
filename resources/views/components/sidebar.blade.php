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
			"flex flex-col z-40 left-0 top-0 transform h-screen overflow-y-scroll lg:overflow-y-auto no-scrollbar shrink-0 bg-white dark:bg-gray-900 transition-all ease-in-out w-72",
		])
	}}
>
	{{ $slot }}
</div>