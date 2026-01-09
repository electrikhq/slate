{{-- resizable-handle.blade.php --}}
@props([
    'withHandle' => true, // Show visual handle
])

@php
    $handleId = $attributes->get('id', 'handle-' . uniqid());
@endphp

<div
    x-data="{
        isResizing: false,
        startX: 0,
        startY: 0,
        startSize: 0,
        leftPanel: null,
        rightPanel: null,
        resizableData: null,
        handleMouseDown(event) {
            event.preventDefault();
            this.isResizing = true;
            this.startX = event.clientX;
            this.startY = event.clientY;
            
            // Get parent resizable
            const resizable = this.$el.closest('[data-resizable]');
            if (!resizable || !resizable.__x) return;
            
            this.resizableData = resizable.__x.$data;
            
            // Find adjacent panels (previous and next sibling)
            let prevPanel = this.$el.previousElementSibling;
            let nextPanel = this.$el.nextElementSibling;
            
            // Walk backwards to find the previous panel
            while (prevPanel && !prevPanel.hasAttribute('data-resizable-panel')) {
                prevPanel = prevPanel.previousElementSibling;
            }
            
            // Walk forwards to find the next panel
            while (nextPanel && !nextPanel.hasAttribute('data-resizable-panel')) {
                nextPanel = nextPanel.nextElementSibling;
            }
            
            if (!prevPanel || !nextPanel || !prevPanel.__x || !nextPanel.__x) return;
            
            this.leftPanel = prevPanel.__x.$data;
            this.rightPanel = nextPanel.__x.$data;
            this.startSize = this.leftPanel.size;
            
            const moveHandler = (e) => this.handleMouseMove(e);
            const upHandler = () => this.handleMouseUp();
            
            document.addEventListener('mousemove', moveHandler);
            document.addEventListener('mouseup', upHandler);
            
            // Store handlers for cleanup
            this._moveHandler = moveHandler;
            this._upHandler = upHandler;
        },
        handleMouseMove(event) {
            if (!this.isResizing || !this.leftPanel || !this.rightPanel || !this.resizableData) return;
            
            const deltaX = event.clientX - this.startX;
            const deltaY = event.clientY - this.startY;
            const delta = this.resizableData.isHorizontal ? deltaX : deltaY;
            
            const resizable = this.$el.closest('[data-resizable]');
            const containerSize = this.resizableData.isHorizontal ? resizable.offsetWidth : resizable.offsetHeight;
            const deltaPercent = (delta / containerSize) * 100;
            
            const newSize = Math.max(
                this.leftPanel.minSize,
                Math.min(this.leftPanel.maxSize, this.startSize + deltaPercent)
            );
            
            this.leftPanel.size = newSize;
            this.rightPanel.size = 100 - newSize;
        },
        handleMouseUp() {
            this.isResizing = false;
            if (this._moveHandler) {
                document.removeEventListener('mousemove', this._moveHandler);
            }
            if (this._upHandler) {
                document.removeEventListener('mouseup', this._upHandler);
            }
            this._moveHandler = null;
            this._upHandler = null;
        }
    }"
    @mousedown="handleMouseDown($event)"
    {{ $attributes->merge([
        'class' => $withHandle 
            ? 'relative flex w-px items-center justify-center bg-border after:absolute after:inset-y-0 after:left-1/2 after:w-1 after:-translate-x-1/2 cursor-col-resize hover:bg-primary transition-colors select-none'
            : 'relative flex w-px bg-border cursor-col-resize hover:bg-primary transition-colors select-none'
    ]) }}
>
    @if($withHandle)
        <div class="z-10 flex h-4 w-3 items-center justify-center rounded-sm border border-border bg-background">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="8"
                height="8"
                viewBox="0 0 8 8"
                fill="none"
                stroke="currentColor"
                stroke-width="1"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="h-2.5 w-2.5"
            >
                <path d="M2 2v4M6 2v4" />
            </svg>
        </div>
    @endif
</div>

