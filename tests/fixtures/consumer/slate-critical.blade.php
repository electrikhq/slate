<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Slate critical smoke</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-background text-foreground min-h-screen antialiased">
    <x-slate::toaster />

    <x-slate::app-shell class="min-h-screen">
        <x-slot:header>
            <span class="text-sm font-medium" data-testid="app-shell-header">Slate critical smoke</span>
        </x-slot:header>

        <x-slot:sidebar>
            <aside class="flex h-full w-52 flex-col gap-2 border-e bg-sidebar p-4 text-sidebar-foreground">
                <p class="text-sm font-medium" data-testid="app-shell-sidebar">Sidebar</p>
            </aside>
        </x-slot:sidebar>

        <x-slot:main>
            <div class="mx-auto flex w-full max-w-2xl flex-col gap-8 p-6">
                <section class="space-y-3" data-testid="section-button">
                    <h1 class="text-2xl font-semibold tracking-tight">Critical components</h1>
                    <x-slate::button data-testid="smoke-button">Save changes</x-slate::button>
                </section>

                <section class="space-y-3" data-testid="section-input-error">
                    <h2 class="text-lg font-medium">Input + error</h2>
                    <x-slate::input
                        label="Email"
                        type="email"
                        name="email"
                        aria-invalid="true"
                        errorMessage="Please enter a valid email address."
                        data-testid="smoke-input"
                    />
                </section>

                <section class="space-y-3" data-testid="section-dialog">
                    <h2 class="text-lg font-medium">Dialog</h2>
                    <x-slate::dialog>
                        <x-slate::dialog-trigger>
                            <x-slate::button variant="outline" data-testid="smoke-dialog-trigger">Open dialog</x-slate::button>
                        </x-slate::dialog-trigger>
                        <x-slate::dialog-content title="Edit profile" description="Update your account details.">
                            <p data-testid="smoke-dialog-body">Dialog body</p>
                        </x-slate::dialog-content>
                    </x-slate::dialog>
                </section>

                <section class="space-y-3" data-testid="section-toast">
                    <h2 class="text-lg font-medium">Toast</h2>
                    <x-slate::button
                        type="button"
                        variant="secondary"
                        data-testid="smoke-toast-trigger"
                        x-on:click="window.dispatchEvent(new CustomEvent('slate-toast', { detail: { title: 'Saved', description: 'Your changes were stored.', variant: 'success' } }))"
                    >
                        Show toast
                    </x-slate::button>
                </section>
            </div>
        </x-slot:main>
    </x-slate::app-shell>
</body>
</html>
