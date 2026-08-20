@props([
    'orientation' => 'horizontal',
    'as' => 'div',
])

@php
    $resolvedOrientation = in_array($orientation, ['horizontal', 'vertical'], true)
        ? $orientation
        : 'horizontal';

    $classes = trim(implode(' ', [
        'flex h-full w-full',
        $resolvedOrientation === 'vertical' ? 'flex-col' : 'flex-row',
    ]));
@endphp

<{{ $as }}
    data-slot="resizable-panel-group"
    data-orientation="{{ $resolvedOrientation }}"
    x-data="{
        orientation: @js($resolvedOrientation),
        sizes: [],
        dragging: false,
        init() {
            const panels = Array.from(this.$el.querySelectorAll('[data-slot=resizable-panel]'));
            const count = panels.length;
            if (count === 0) return;

            const defaults = panels.map((panel) => {
                const raw = panel.getAttribute('data-default-size');
                return raw !== null && raw !== '' ? Number(raw) : null;
            });

            if (defaults.every((value) => Number.isFinite(value))) {
                const total = defaults.reduce((sum, value) => sum + value, 0) || 100;
                this.sizes = defaults.map((value) => (value / total) * 100);
            } else {
                const equal = 100 / count;
                this.sizes = Array.from({ length: count }, () => equal);
            }
        },
        pointerPos(event) {
            if (event.touches && event.touches[0]) {
                return this.orientation === 'horizontal' ? event.touches[0].clientX : event.touches[0].clientY;
            }
            if (event.changedTouches && event.changedTouches[0]) {
                return this.orientation === 'horizontal' ? event.changedTouches[0].clientX : event.changedTouches[0].clientY;
            }
            return this.orientation === 'horizontal' ? event.clientX : event.clientY;
        },
        startDrag(index, event) {
            if (event.button != null && event.button !== 0) return;
            event.preventDefault();

            const startPos = this.pointerPos(event);
            const startSizes = this.sizes.slice();
            const pair = (startSizes[index] ?? 0) + (startSizes[index + 1] ?? 0);
            const min = 10;
            const total = this.$el.getBoundingClientRect()[this.orientation === 'horizontal' ? 'width' : 'height'];
            if (! total || pair <= 0) return;

            this.dragging = true;
            document.body.style.cursor = this.orientation === 'horizontal' ? 'col-resize' : 'row-resize';
            document.body.style.userSelect = 'none';

            const onMove = (moveEvent) => {
                moveEvent.preventDefault();
                const current = this.pointerPos(moveEvent);
                const delta = ((current - startPos) / total) * 100;
                let nextFirst = startSizes[index] + delta;
                nextFirst = Math.max(min, Math.min(pair - min, nextFirst));
                const nextSecond = pair - nextFirst;

                this.sizes = this.sizes.map((size, i) => {
                    if (i === index) return nextFirst;
                    if (i === index + 1) return nextSecond;
                    return size;
                });
            };

            const onUp = () => {
                this.dragging = false;
                document.body.style.cursor = '';
                document.body.style.userSelect = '';
                window.removeEventListener('pointermove', onMove);
                window.removeEventListener('pointerup', onUp);
                window.removeEventListener('pointercancel', onUp);
                window.removeEventListener('mousemove', onMove);
                window.removeEventListener('mouseup', onUp);
                window.removeEventListener('touchmove', onMove);
                window.removeEventListener('touchend', onUp);
                window.removeEventListener('touchcancel', onUp);
            };

            window.addEventListener('pointermove', onMove, { passive: false });
            window.addEventListener('pointerup', onUp);
            window.addEventListener('pointercancel', onUp);
            window.addEventListener('mousemove', onMove);
            window.addEventListener('mouseup', onUp);
            window.addEventListener('touchmove', onMove, { passive: false });
            window.addEventListener('touchend', onUp);
            window.addEventListener('touchcancel', onUp);
        }
    }"
    x-bind:data-dragging="dragging ? 'true' : 'false'"
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</{{ $as }}>
