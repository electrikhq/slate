---
name: electrik-slate
description: >-
  Build Laravel Blade UI with Electrik Slate 3.x. Use when writing x-slate
  components, Livewire forms, tokens, toasts, blocks, or when the user mentions
  Slate, electrik/slate, or slate.electrik.dev.
---

# Electrik Slate

## Quick facts

- Package: `electrik/slate` (Composer), branch/line `3.x` / `3.0.0-alpha.*`
- Docs: https://slate.electrik.dev
- AI index: https://slate.electrik.dev/llms.txt
- MCP: `@electrik/slate-mcp` in repo `mcp/` (read-only docs + Blade source)

## Do

1. Fetch component docs (`/components/{slug}.md`) or use MCP `get_component_docs` before coding.
2. Use progressive form props and documented composition trees.
3. Copy patterns from `/blocks` when building login, settings, pricing, app shell.
4. Keep Alpine state on the Slate root for overlays.

## Don't

- Invent a `npx slate add` / registry install flow.
- Generate React, Vue, or shadcn/ui TSX for Slate apps.
- Nest identical `<x-slate::*>` components or put `@if` in opening tags.

## Toast snippet

```blade
<x-slate::toaster />

<x-slate::button
    @click="$dispatch('slate-toast', { title: 'Saved', variant: 'success' })"
>
    Save
</x-slate::button>
```
