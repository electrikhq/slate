@props([
    'position' => 'bottom-end',
    'duration' => 4000,
    'as' => 'div',
])

@php
    $resolvedPosition = in_array($position, [
        'top-start', 'top-center', 'top-end',
        'bottom-start', 'bottom-center', 'bottom-end',
    ], true) ? $position : 'bottom-end';

    $defaultDuration = max(0, (int) $duration);

    $positionClasses = [
        'top-start' => 'top-0 start-0 items-start p-4 sm:p-6',
        'top-center' => 'top-0 inset-x-0 mx-auto items-center p-4 sm:p-6',
        'top-end' => 'top-0 end-0 items-end p-4 sm:p-6',
        'bottom-start' => 'bottom-0 start-0 items-start p-4 sm:p-6',
        'bottom-center' => 'bottom-0 inset-x-0 mx-auto items-center p-4 sm:p-6',
        'bottom-end' => 'bottom-0 end-0 items-end p-4 sm:p-6',
    ];

    $stackClasses = trim(implode(' ', [
        'pointer-events-none fixed z-[100] flex w-full max-w-[360px] gap-2 md:max-w-[420px]',
        str_starts_with($resolvedPosition, 'bottom') ? 'flex-col-reverse' : 'flex-col',
        $positionClasses[$resolvedPosition],
    ]));
@endphp

{{-- Fixed viewport stack. Prefer mounting near the end of <body>. --}}
<div hidden x-data>
    <template x-teleport="body">
        <{{ $as }}
            data-slot="toaster"
            data-position="{{ $resolvedPosition }}"
            x-data="{
                toasts: [],
                defaultDuration: {{ $defaultDuration }},
                add(detail = {}) {
                    const id = detail.id ?? ('toast-' + Date.now() + '-' + Math.random().toString(36).slice(2, 8));
                    const toast = {
                        id,
                        title: detail.title ?? '',
                        description: detail.description ?? '',
                        variant: detail.variant ?? 'default',
                        duration: detail.duration != null ? Number(detail.duration) : this.defaultDuration,
                        open: false,
                    };
                    this.toasts = [...this.toasts, toast];
                    this.$nextTick(() => {
                        this.toasts = this.toasts.map((item) => item.id === id ? { ...item, open: true } : item);
                    });
                    if (toast.duration > 0) {
                        setTimeout(() => this.dismiss(id), toast.duration);
                    }
                },
                dismiss(id) {
                    this.toasts = this.toasts.map((item) => item.id === id ? { ...item, open: false } : item);
                    setTimeout(() => {
                        this.toasts = this.toasts.filter((item) => item.id !== id);
                    }, 320);
                }
            }"
            x-on:slate-toast.window="add($event.detail || {})"
            {{ $attributes->merge(['class' => $stackClasses]) }}
        >
            @include('slate::components.partials.toaster-stack')
        </{{ $as }}>
    </template>
</div>
