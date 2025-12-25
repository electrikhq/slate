@php
    // Auto-detect primary sidebar if authenticated and not explicitly provided
    $autoPrimarySidebar = false;
    if (!isset($primarySidebar) && auth()->check() && view()->exists('includes.livewire.primary-sidebar')) {
        $autoPrimarySidebar = true;
    }

    // Auto-detect secondary sidebar by default, fallback to explicit sidebar if auto-detection doesn't find anything
    $autoSidebar = null;
    $routeName = request()->route()?->getName();
    
    if ($routeName) {
        // Map account/settings routes to use settings sidebar
        if (str_starts_with($routeName, 'settings.') || str_starts_with($routeName, 'account.')) {
            if (view()->exists('includes.livewire.sidebar.settings')) {
                $autoSidebar = 'includes.livewire.sidebar.settings';
            }
        } else {
            // Split route name into segments
            $segments = explode('.', $routeName);
            
            // Try progressively shorter paths (most specific to least specific)
            $paths = [];
            $currentPath = 'includes.livewire.sidebar';
            
            // Remove the last segment (usually the action like 'index', 'settings', 'create')
            // and build paths for each level
            for ($i = 0; $i < count($segments) - 1; $i++) {
                $currentPath .= '.' . $segments[$i];
                $paths[] = $currentPath;
            }
            
            // Reverse order to check most specific first
            $paths = array_reverse($paths);
            
            // Check if any of these views exist
            foreach ($paths as $path) {
                if (view()->exists($path)) {
                    $autoSidebar = $path;
                    break;
                }
            }
        }
    }
    
    // Use auto-detected sidebar if found, otherwise fallback to explicit sidebar
    $finalSidebar = $autoSidebar ? $autoSidebar : (isset($sidebar) ? $sidebar : null);
@endphp

<div x-data="{ sidebarOpen: true }" @toggle-sidebar.window="sidebarOpen = !sidebarOpen" class="flex min-h-full overflow-hidden">
    <!-- Primary Sidebar -->
    @if(isset($primarySidebar))
    <div class="flex flex-col w-14 lg:w-16 items-center bg-neutral-200 dark:bg-black">
        {{ $primarySidebar ?? '' }}
    </div>
    @elseif($autoPrimarySidebar)
    <div class="flex flex-col w-14 lg:w-16 items-center bg-neutral-200 dark:bg-black">
        @include('includes.livewire.primary-sidebar')
    </div>
    @endif

    <!-- Secondary Sidebar -->
    @if($finalSidebar)
    <div :class="sidebarOpen ? 'w-64' : 'w-0'" class="bg-neutral-100 dark:bg-black dark:border-l-[1px] dark:border-neutral-900/60 dark:border-r-[1px] transition-width duration-300 overflow-hidden">
        @if(is_string($finalSidebar) && str_contains($finalSidebar, '.'))
            @include($finalSidebar)
        @else
            {!! $finalSidebar !!}
        @endif
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
