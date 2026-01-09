{{-- toaster.blade.php --}}
@props([
    'position' => 'top-right', // top-right, top-left, bottom-right, bottom-left, top-center, bottom-center
])

@php
    $positionClasses = [
        'top-right' => 'top-0 right-0',
        'top-left' => 'top-0 left-0',
        'bottom-right' => 'bottom-0 right-0',
        'bottom-left' => 'bottom-0 left-0',
        'top-center' => 'top-0 left-1/2 -translate-x-1/2',
        'bottom-center' => 'bottom-0 left-1/2 -translate-x-1/2',
    ];
    
    $positionClass = $positionClasses[$position] ?? $positionClasses['top-right'];
@endphp

<div
    x-data="{
        toasts: [],
        addToast(toast) {
            const id = 'toast-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);
            const newToast = {
                id: id,
                title: toast.title || '',
                description: toast.description || '',
                variant: toast.variant || 'default',
                duration: toast.duration !== undefined ? toast.duration : 5000,
                action: toast.action || null,
                ...toast
            };
            this.toasts.push(newToast);
            
            if (newToast.duration > 0) {
                setTimeout(() => {
                    this.removeToast(id);
                }, newToast.duration);
            }
            
            return id;
        },
        removeToast(id) {
            this.toasts = this.toasts.filter(toast => toast.id !== id);
        },
        init() {
            // Make toaster available globally
            window.$toaster = this;
            // Also listen for toast events
            window.addEventListener('slate:toast', (e) => {
                if (e.detail) {
                    this.addToast(e.detail);
                }
            });
        }
    }"
    class="fixed z-[100] flex flex-col gap-2 p-4 {{ $positionClass }} pointer-events-none"
    aria-live="polite"
    aria-atomic="true"
    {{ $attributes }}
>
    <template x-for="toast in toasts" :key="toast.id">
        <div
            x-data="{
                show: true,
                get parentToaster() {
                    return this.$el.closest('[x-data]').__x.$data;
                },
                close() {
                    this.show = false;
                    setTimeout(() => {
                        if (this.parentToaster) {
                            this.parentToaster.removeToast(toast.id);
                        }
                    }, 200);
                }
            }"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-2 sm:translate-y-0 sm:translate-x-2"
            x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:translate-x-0"
            x-transition:leave-end="opacity-0 translate-y-2 sm:translate-y-0 sm:translate-x-2"
            role="alert"
            :class="{
                'bg-background text-foreground border-border': toast.variant === 'default',
                'bg-success/10 text-success border-success/20': toast.variant === 'success',
                'bg-error/10 text-error border-error/20': toast.variant === 'error',
                'bg-warning/10 text-warning border-warning/20': toast.variant === 'warning',
                'bg-info/10 text-info border-info/20': toast.variant === 'info',
            }"
            class="pointer-events-auto relative flex w-full items-center justify-between space-x-4 overflow-hidden rounded-md border p-6 pr-8 shadow-lg max-w-sm"
        >
            <div class="grid gap-1 flex-1">
                <template x-if="toast.title">
                    <div class="text-sm font-semibold" x-text="toast.title"></div>
                </template>
                <template x-if="toast.description">
                    <div class="text-sm opacity-90" x-text="toast.description"></div>
                </template>
            </div>
            
            <template x-if="toast.action">
                <div class="flex items-center gap-2">
                    <button
                        type="button"
                        @click="toast.action.onClick && toast.action.onClick(); close()"
                        class="inline-flex h-8 shrink-0 items-center justify-center rounded-md border border-transparent bg-transparent px-3 text-sm font-medium ring-offset-background transition-colors hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2"
                    >
                        <span x-text="toast.action.label || 'Action'"></span>
                    </button>
                </div>
            </template>
            
            <button
                type="button"
                @click="close()"
                class="absolute right-2 top-2 rounded-md p-1 text-foreground/50 opacity-0 transition-opacity hover:text-foreground focus:opacity-100 focus:outline-none focus:ring-2 group-hover:opacity-100"
                aria-label="Close"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="12"
                    height="12"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M18 6L6 18M6 6l12 12" />
                </svg>
            </button>
        </div>
    </template>
</div>

