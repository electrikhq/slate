@props([
    'color' => 'light',
])

<div x-data="{ sidebarOpen: true }" @toggle-sidebar.window="sidebarOpen = !sidebarOpen" class="flex h-screen overflow-hidden">
    <!-- Primary Sidebar -->
    <div class="flex flex-col h-screen w-14 justify-between items-center py-4 bg-gray-200 dark:bg-black">
        <div>
            <x-slate::icon icon="carbon-dashboard" size="md" class="hover:text-gray-700 cursor-pointer" />
            <!-- Additional primary sidebar icons -->
        </div>
        <div>
            <!-- Icons or buttons at the bottom of the primary sidebar -->
        </div>
    </div>

    <!-- Secondary Sidebar -->
    <div :class="sidebarOpen ? 'w-64' : 'w-0'" class="bg-gray-100 dark:bg-gray-950 transition-width duration-300 overflow-hidden">
        <div class="py-4 space-y-2">
            {{ $sidebar ?? '' }}
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col">
        <!-- Top Navigation Bar -->
        <div class="bg-white dark:bg-black">
            <div class="max-w-full w-full">
                <div class="flex justify-between items-center ">
                    <!-- Placeholder for content in the navbar -->
                    {{ $navbar ?? '' }}
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="flex-1 overflow-y-auto bg-white dark:bg-black dark:border-l-[1px] dark:border-gray-900/60">
            {{ $slot }}
        </div>
    </div>
</div>