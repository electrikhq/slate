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
        mins: [],
        dragging: false,
        dragIndex: null,
        startPos: 0,
        startSizes: [],
        pair: 0,
        total: 0,
        init() {
            const panels = Array.from(this.$el.querySelectorAll(':scope > [data-slot=resizable-panel]'));
            const count = panels.length;
            if (count === 0) return;

            this.mins = panels.map((panel) => {
                const raw = Number(panel.getAttribute('data-min-size'));
                return Number.isFinite(raw) ? Math.max(5, raw) : 10;
            });

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
            const point = event.touches?.[0] || event.changedTouches?.[0] || event;
            return this.orientation === 'horizontal' ? point.clientX : point.clientY;
        },
        startDrag(index, event) {
            if (event.button != null && event.button !== 0) return;
            event.preventDefault();
            event.stopPropagation();

            this.startPos = this.pointerPos(event);
            this.startSizes = this.sizes.slice();
            this.pair = (this.startSizes[index] ?? 0) + (this.startSizes[index + 1] ?? 0);
            this.total = this.$el.getBoundingClientRect()[this.orientation === 'horizontal' ? 'width' : 'height'];
            if (! this.total || this.pair <= 0) return;

            this.dragIndex = index;
            this.dragging = true;
            document.body.style.cursor = this.orientation === 'horizontal' ? 'col-resize' : 'row-resize';
            document.body.style.userSelect = 'none';

            const handle = event.currentTarget;
            if (handle?.setPointerCapture && event.pointerId != null) {
                try { handle.setPointerCapture(event.pointerId); } catch (_) {}
            }

            this._onMove = (moveEvent) => this.onDrag(moveEvent);
            this._onUp = (upEvent) => this.endDrag(upEvent);

            window.addEventListener('pointermove', this._onMove, { passive: false });
            window.addEventListener('pointerup', this._onUp);
            window.addEventListener('pointercancel', this._onUp);
        },
        onDrag(event) {
            if (! this.dragging || this.dragIndex === null) return;
            event.preventDefault();

            const index = this.dragIndex;
            const minA = this.mins[index] ?? 10;
            const minB = this.mins[index + 1] ?? 10;
            const current = this.pointerPos(event);
            const delta = ((current - this.startPos) / this.total) * 100;
            let nextFirst = this.startSizes[index] + delta;
            nextFirst = Math.max(minA, Math.min(this.pair - minB, nextFirst));
            const nextSecond = this.pair - nextFirst;

            this.sizes = this.sizes.map((size, i) => {
                if (i === index) return nextFirst;
                if (i === index + 1) return nextSecond;
                return size;
            });
        },
        endDrag(event) {
            if (! this.dragging) return;
            const handle = event?.currentTarget;
            if (handle?.releasePointerCapture && event.pointerId != null) {
                try { handle.releasePointerCapture(event.pointerId); } catch (_) {}
            }
            this.dragging = false;
            this.dragIndex = null;
            document.body.style.cursor = '';
            document.body.style.userSelect = '';
            window.removeEventListener('pointermove', this._onMove);
            window.removeEventListener('pointerup', this._onUp);
            window.removeEventListener('pointercancel', this._onUp);
            this._onMove = null;
            this._onUp = null;
        }
    }"
    x-bind:data-dragging="dragging ? 'true' : 'false'"
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</{{ $as }}>
