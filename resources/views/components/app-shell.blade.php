{{-- app-shell.blade.php --}}
@props([
    'sidebar' => null,
    'header' => null,
    'footer' => null,
    'sidebarCollapsible' => true,
    'sidebarDefaultOpen' => true,
    'sidebarWidth' => 'w-64',
    'sidebarCollapsedWidth' => 'w-16',
])

<div class="flex h-screen w-full overflow-hidden bg-background">
    {{-- Sidebar --}}
    @if($sidebar)
        <x-slate::app-shell-sidebar 
            :collapsible="$sidebarCollapsible"
            :defaultOpen="$sidebarDefaultOpen"
            :width="$sidebarWidth"
            :collapsedWidth="$sidebarCollapsedWidth"
        >
            {{ $sidebar }}
        </x-slate::app-shell-sidebar>
    @endif

    {{-- Main Content Area --}}
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        {{-- Header --}}
        @if($header)
            <x-slate::app-shell-header>
                {{ $header }}
            </x-slate::app-shell-header>
        @endif

        {{-- Page Content --}}
        <main class="flex-1 overflow-y-auto">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        @if($footer)
            <x-slate::app-shell-footer>
                {{ $footer }}
            </x-slate::app-shell-footer>
        @endif
    </div>
</div>

