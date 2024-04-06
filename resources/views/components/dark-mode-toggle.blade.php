<div x-data="themeToggle()" class="">
    <button 
        size="xs"
        @click="setTheme('system')"
    >
        <x-slate::icon icon="carbon-laptop" size="xs" />
    </button>
    <button 
        size="xs"
        @click="setTheme('dark')"
    >
        <x-slate::icon icon="carbon-asleep" size="xs" />
    </button>
    <button 
        size="xs"
        @click="setTheme('light')"
    >
        <x-slate::icon icon="carbon-awake" size="xs" />
    </button>
</div>

<script>
    function themeToggle() {
        return {
            theme: localStorage.getItem('theme') ?? 'system',
            init() {
                this.applyTheme();
                // Listen for system color scheme changes
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                    if (this.theme === 'system') {
                        this.applyTheme();
                    }
                });
            },
            setTheme(selectedTheme) {
                this.theme = selectedTheme;
                localStorage.setItem('theme', selectedTheme);
                this.applyTheme();
            },
            applyTheme() {
                if (this.theme === 'system') {
                    if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                } else {
                    document.documentElement.classList.toggle('dark', this.theme === 'dark');
                }
            }
        };
    }
</script>