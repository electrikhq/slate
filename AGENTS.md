# Electrik Slate — agent notes

Use these rules when generating Laravel Blade UI with **Electrik Slate** (`electrik/slate` 3.x).

## Stack

- Anonymous Blade components: `<x-slate::name />`
- Tailwind CSS v4 + Slate OKLCH tokens (`--slate-*`)
- Alpine.js only when interactivity is required
- Livewire-friendly forms (do not invent React/shadcn or a CLI `add` command)

## Install reminder

```bash
composer require electrik/slate:^3.0
```

Import after Tailwind:

```css
@import 'tailwindcss';
@import '../../vendor/electrik/slate/resources/css/slate.css';
```

## Authoring rules

1. Prefer progressive props: `label`, `description`, `errorMessage` on form controls.
2. Do not nest the same Blade component inside itself.
3. Do not put `@if` inside `<x-slate::*>` opening tags — compute classes in `@php` first.
4. Use logical CSS (`start` / `end`) over `left` / `right` when touching layout.
5. Mount `<x-slate::toaster />` once in the layout; dispatch `slate-toast` browser events.
6. For busy buttons: `loading` / `loadingText` (static/Alpine) or Livewire `wire:loading`.
7. Theme via CSS variables (`--slate-primary`, etc.), not hardcoded hex in components.
8. Compose overlays from documented parts (`dialog` + `dialog-trigger` + `dialog-content`, …).

## AI sources

- https://slate.electrik.dev/llms.txt
- https://slate.electrik.dev/components/{name}.md
- MCP: see `mcp/README.md` and https://slate.electrik.dev/docs/ai

## Good prompts for agents

- “Build a settings form with Slate progressive field props and a destructive alert.”
- “Use the login block pattern from slate.electrik.dev/blocks/login.”
- “Fetch dialog docs via MCP and wire Alpine open state.”
