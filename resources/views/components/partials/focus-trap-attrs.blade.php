{{-- Shared focus trap + restore for modal panels (dialog / sheet / drawer / alert-dialog). --}}
x-effect="
    if (open) {
        if (!$el._slatePrevFocus) $el._slatePrevFocus = document.activeElement;
        $nextTick(() => $el.focus({ preventScroll: true }));
    } else if ($el._slatePrevFocus) {
        const prev = $el._slatePrevFocus;
        $el._slatePrevFocus = null;
        $nextTick(() => prev?.focus?.({ preventScroll: true }));
    }
"
@keydown.tab="
    const nodes = [...$el.querySelectorAll('a[href], button:not([disabled]), textarea:not([disabled]), input:not([disabled]):not([type=\'hidden\']), select:not([disabled]), [tabindex]:not([tabindex=\'-1\']), [contenteditable=\'true\']')].filter((el) => !el.hasAttribute('disabled') && !el.getAttribute('aria-hidden') && el.getClientRects().length > 0);
    if (!nodes.length) { $event.preventDefault(); return; }
    const first = nodes[0];
    const last = nodes[nodes.length - 1];
    if ($event.shiftKey && document.activeElement === first) { $event.preventDefault(); last.focus(); }
    else if (!$event.shiftKey && document.activeElement === last) { $event.preventDefault(); first.focus(); }
"
