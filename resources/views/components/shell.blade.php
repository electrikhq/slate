<div x-data="{ sidebarOpen: true }" @toggle-sidebar.window="sidebarOpen = !sidebarOpen" class="flex min-h-full overflow-hidden">
    <!-- Primary Sidebar -->
    @if(isset($primarySidebar))
    <div class="flex flex-col w-14 lg:w-16 items-center py-4 bg-neutral-200 dark:bg-black">
        {{ $primarySidebar ?? '' }}
    </div>
    @endif

    <!-- Secondary Sidebar -->
    @if(isset($sidebar))
    <div :class="sidebarOpen ? 'w-64' : 'w-0'" class="bg-neutral-100 dark:bg-black dark:border-l-[1px] dark:border-neutral-900/60 dark:border-r-[1px] transition-width duration-300 overflow-hidden">
        <div class="py-4 space-y-2">
            {{ $sidebar ?? '' }}
        </div>
    </div>
    @endif

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col">
        <!-- Top Navigation Bar -->
        <div class="bg-white dark:bg-black">
            <div class="max-w-full w-full">
                <div class="flex items-start">
                    <!-- Placeholder for content in the navbar -->
                    {{ $navbar ?? '' }}
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="flex-1 overflow-y-auto bg-white dark:bg-black">
            {{ $slot }}
        </div>
    </div>
</div>
