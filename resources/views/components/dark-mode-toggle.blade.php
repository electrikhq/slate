@props([
    'variant' => 'ghost',
    'size' => 'default',
    'icon' => null,
])

@php
    $icon = $icon ?? 'carbon-contrast';
@endphp

{{-- Immediate script to prevent flash of incorrect theme --}}
<script>
    (function() {
        const stored = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const shouldBeDark = stored === 'dark' || (!stored && prefersDark);
        
        if (shouldBeDark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    })();
</script>

<div 
    x-data="{
        dark: false,
        init() {
            // Check localStorage on init and sync with current state
            const stored = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            
            // Use stored preference, or fall back to system preference
            this.dark = stored === 'dark' || (!stored && prefersDark);
            // Sync with current DOM state (in case script above already set it)
            this.dark = document.documentElement.classList.contains('dark');
        },
        toggle() {
            this.dark = !this.dark;
            this.updateTheme();
            // Persist to localStorage
            localStorage.setItem('theme', this.dark ? 'dark' : 'light');
        },
        updateTheme() {
            if (this.dark) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
    }"
    x-init="init()"
>
    <x-slate::button 
        :variant="$variant" 
        :size="$size" 
        :icon="$icon"
        @click="toggle()"
        aria-label="Toggle dark mode"
    />
</div>
