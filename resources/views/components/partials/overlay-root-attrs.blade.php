{{-- Shared Alpine root for dialog / sheet / drawer / alert-dialog.
     Nesting-safe scroll-lock + Escape only closes the topmost overlay. --}}
@php
    $isOpen = filter_var($open ?? false, FILTER_VALIDATE_BOOL);
@endphp
x-data="{
    open: {{ $isOpen ? 'true' : 'false' }},
    init() {
        window.__slateOverlayStack = window.__slateOverlayStack || [];
    },
    syncOverlayLock(isOpen) {
        window.__slateOverlayStack = window.__slateOverlayStack || [];
        const stack = window.__slateOverlayStack;
        const idx = stack.indexOf(this);
        if (isOpen) {
            if (idx === -1) stack.push(this);
            document.documentElement.classList.add('slate-scroll-lock');
        } else if (idx !== -1) {
            stack.splice(idx, 1);
            if (stack.length === 0) {
                document.documentElement.classList.remove('slate-scroll-lock');
            }
        }
    },
    isTopOverlay() {
        const stack = window.__slateOverlayStack || [];
        return stack.length > 0 && stack[stack.length - 1] === this;
    }
}"
x-effect="syncOverlayLock(open)"
x-on:keydown.escape.window="if (open && isTopOverlay()) open = false"
