---
name: electrik-slate
description: >-
  Build Laravel Blade UI with Electrik Slate 3.x and optional slate-blocks /
  slate-illustrations. Use when writing x-slate, x-slate-block, or
  x-slate-illustration components, Livewire forms, tokens, toasts, blocks,
  illustrations, or when the user mentions Slate, electrik/slate,
  electrik/slate-blocks, electrik/slate-illustrations, or slate.electrik.dev.
---

# Electrik Slate

## Quick facts

- Package: `electrik/slate` (Composer), line `3.x` / `^3.0`
- Blocks: `electrik/slate-blocks` — curated `<x-slate-block::*>` sections (~24)
- Illustrations: `electrik/slate-illustrations` — animated UI scenes for landing pages (`<x-slate-illustration::deploy />`). Decorative. Use blocks for live login/settings/pricing.
- Docs: https://slate.electrik.dev
- AI index: https://slate.electrik.dev/llms.txt
- MCP: `@electrik/slate-mcp` in repo `mcp/` (read-only docs + Blade source)

## Do

1. Fetch component docs (`/components/{slug}.md`) or use MCP `get_component_docs` before coding.
2. Use progressive form props and documented composition trees.
3. Prefer `<x-slate-block::*>` from the package for login, settings, pricing, FAQ, CTA, app shell — do not paste one-off demos from thin gallery wrappers unless adapting props.
4. Keep Alpine state on the Slate root for overlays.
5. Theme via `--slate-*` tokens (default is neutral/achromatic; accents are optional).

## Don't

- Invent a `npx slate add` / registry install flow.
- Generate React, Vue, or shadcn/ui TSX for Slate apps.
- Nest identical `<x-slate::*>` components or put `@if` in opening tags.
- Treat slate-blocks as a thousand-block marketplace — curated Electrik-shaped set only.

## Toast snippet

```blade
<x-slate::toaster />

<x-slate::button
    @click="$dispatch('slate-toast', { title: 'Saved', variant: 'success' })"
>
    Save
</x-slate::button>
```

## Block snippet

```blade
<x-slate-block::hero
    title="Ship your SaaS"
    description="Auth, teams, and billing on Laravel."
    primary-href="/install"
    primary-label="Install"
/>
```

## Illustration snippet

Decorative scenes for landing pages, not live UI. Pass your own copy. Docs: https://slate.electrik.dev/docs/illustrations

```blade
<x-slate-illustration::deploy
    headline="main · ship-42"
    :jobs="[
        ['title' => 'Install dependencies', 'hint' => 'composer + npm'],
        ['title' => 'Deploy to production', 'hint' => 'Forge · acme.com'],
    ]"
/>
```
