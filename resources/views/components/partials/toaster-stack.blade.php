<template x-for="toast in toasts" :key="toast.id">
    <div
        data-slot="toast"
        role="status"
        aria-live="polite"
        x-show="toast.open"
        x-cloak
        x-bind:data-variant="toast.variant"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        class="pointer-events-auto relative flex w-full items-start gap-3 overflow-hidden rounded-lg border bg-background p-4 pe-10 shadow-lg"
        x-bind:class="{
            'border-border text-foreground': !toast.variant || toast.variant === 'default',
            'border-destructive/40 text-destructive': toast.variant === 'destructive',
            'border-success/40 text-success': toast.variant === 'success',
            'border-warning/40 text-warning': toast.variant === 'warning',
            'border-info/40 text-info': toast.variant === 'info'
        }"
    >
        <div class="grid flex-1 gap-0.5">
            <div
                data-slot="toast-title"
                class="text-sm font-semibold"
                x-show="toast.title"
                x-text="toast.title"
            ></div>
            <div
                data-slot="toast-description"
                class="text-sm"
                x-show="toast.description"
                x-text="toast.description"
                x-bind:class="{
                    'text-muted-foreground': !toast.variant || toast.variant === 'default',
                    'text-destructive/90': toast.variant === 'destructive',
                    'text-success/90': toast.variant === 'success',
                    'text-warning/90': toast.variant === 'warning',
                    'text-info/90': toast.variant === 'info'
                }"
            ></div>
        </div>

        <button
            type="button"
            data-slot="toast-close"
            @click="dismiss(toast.id)"
            class="absolute end-2 top-2 rounded-md p-1 opacity-70 transition-opacity hover:opacity-100 focus-visible:opacity-100 focus-visible:outline-hidden focus-visible:ring-2 focus-visible:ring-ring"
            x-bind:class="{
                'text-foreground/50 hover:text-foreground': !toast.variant || toast.variant === 'default',
                'text-destructive/60 hover:text-destructive': toast.variant === 'destructive',
                'text-success/60 hover:text-success': toast.variant === 'success',
                'text-warning/60 hover:text-warning': toast.variant === 'warning',
                'text-info/60 hover:text-info': toast.variant === 'info'
            }"
        >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="size-4" aria-hidden="true">
                <path d="M18 6 6 18" stroke-linecap="round" />
                <path d="m6 6 12 12" stroke-linecap="round" />
            </svg>
            <span class="sr-only">Dismiss</span>
        </button>
    </div>
</template>
