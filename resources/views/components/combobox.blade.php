@props([
    'open' => false,
    'value' => null,
    'name' => null,
    'placeholder' => 'Select...',
    'as' => 'div',
])

@php
    $isOpen = filter_var($open, FILTER_VALIDATE_BOOL);
    $initial = $value ?? '';
    $resolvedName = $name ?? $attributes->get('name');
    $wireAttributes = $attributes->whereStartsWith('wire:model');
    $rootAttributes = $attributes->except(['name'])->whereDoesntStartWith('wire:');
    $listboxId = 'slate-combobox-'.substr(md5(($resolvedName ?? '').$initial.spl_object_id($attributes)), 0, 8);
@endphp

<{{ $as }}
    data-slot="combobox"
    x-data="{
        open: {{ $isOpen ? 'true' : 'false' }},
        value: @js((string) $initial),
        query: @js((string) $initial),
        activeIndex: -1,
        listboxId: @js($listboxId),
        optionEls() {
            return [...this.$root.querySelectorAll('[data-slot=combobox-item]')].filter((el) => el.offsetParent !== null || el.style.display !== 'none');
        },
        visibleOptions() {
            return this.optionEls().filter((el) => {
                if (! this.query) return true;
                const q = this.query.toLowerCase();
                return (el.dataset.value || '').toLowerCase().includes(q) || el.textContent.toLowerCase().includes(q);
            });
        },
        select(val, text) {
            this.value = val;
            this.query = text;
            this.open = false;
            this.activeIndex = -1;
            this.$dispatch('slate-combobox-change', { value: val, label: text });
            this.$nextTick(() => this.$refs.input?.dispatchEvent(new Event('input', { bubbles: true })));
        },
        moveActive(delta) {
            const opts = this.visibleOptions();
            if (! opts.length) { this.activeIndex = -1; return; }
            if (this.activeIndex < 0) {
                this.activeIndex = delta > 0 ? 0 : opts.length - 1;
            } else {
                this.activeIndex = (this.activeIndex + delta + opts.length) % opts.length;
            }
            opts[this.activeIndex]?.scrollIntoView({ block: 'nearest' });
        },
        chooseActive() {
            const opts = this.visibleOptions();
            const el = opts[this.activeIndex];
            if (! el) return;
            this.select(el.dataset.value || '', el.textContent.trim());
        },
        activeId() {
            const opts = this.visibleOptions();
            const el = opts[this.activeIndex];
            return el ? (el.id || null) : null;
        }
    }"
    @keydown.escape.window="if (open) { open = false; activeIndex = -1 }"
    @click.outside="open = false; activeIndex = -1"
    {{ $rootAttributes->merge(['class' => 'relative w-full']) }}
>
    {{ $slot }}
    <input
        type="hidden"
        x-ref="input"
        @if(filled($resolvedName)) name="{{ $resolvedName }}" @endif
        x-bind:value="value"
        {{ $wireAttributes }}
    />
</{{ $as }}>
