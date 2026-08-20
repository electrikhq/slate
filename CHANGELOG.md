# Changelog

All notable changes to the `3.x` line are documented in this file.

## Unreleased

## 3.0.0-alpha.4 - 2026-08-20

### Added

- Consumer sandbox CI (`scripts/setup-consumer-sandbox.sh`, critical smoke page + PHPUnit, GitHub Actions)
- Visual regression Playwright suite for critical demos (light/dark, dialog, toast)
- Shared nesting-safe overlay stack (scroll-lock + topmost Escape) for dialog / sheet / drawer / alert-dialog
- Focus restore to the trigger when overlays close; improved Tab focusables filter
- `prefers-reduced-motion` short-circuit for overlay motion classes
- Docs: [API freeze](https://slate.electrik.dev/docs/api-freeze), [Form matrix](https://slate.electrik.dev/docs/form-matrix)
- Form matrix consumer fixture page
- `@electrik/slate-mcp` `publishConfig.access=public` and version string sync for npm publish

### Changed

- Expand README with banner, product gallery screenshots, TOC, and AI/MCP discoverability copy
- Toaster mounts via Alpine `x-teleport` from a hidden `x-data` host so top-level pages initialize reliably

## 3.0.0-alpha.3 - 2026-08-20

### Added

- AI surface for agents: `llms.txt` / `llms-full.txt` on the docs site, read-only `@electrik/slate-mcp` server (`mcp/`), `AGENTS.md`, Cursor rule, and skill
- Docs page: [AI & MCP](https://slate.electrik.dev/docs/ai)

## 3.0.0-alpha.2 - 2026-08-20

### Added

- Core form primitives: `button`, `input`, `textarea`, `select`, `checkbox`, `switch`, `radio`
- `badge` component
- Card composition: `card`, `card-header`, `card-title`, `card-description`, `card-action`, `card-content`, `card-footer`
- Alert composition: `alert`, `alert-title`, `alert-description`, `alert-action` (progressive `title` / `description` / `action` slot; `default`, `destructive`, `success`, `warning`, `info`)
- `separator` with `orientation` and `decorative` props
- Avatar composition: `avatar`, `avatar-image`, `avatar-fallback`, `avatar-badge`, `avatar-group`, `avatar-group-count` (progressive `src` / `alt` / `fallback` / `dot`)
- `skeleton` loading placeholder
- Dialog composition (Alpine): `dialog`, `dialog-trigger`, `dialog-content`, `dialog-header`, `dialog-footer`, `dialog-title`, `dialog-description`, `dialog-close`
- Tabs composition (Alpine): `tabs`, `tabs-list`, `tabs-trigger`, `tabs-content` (`default` / `line` list variants; horizontal / vertical)
- `spinner` loading indicator
- Breadcrumb composition: `breadcrumb`, `breadcrumb-list`, `breadcrumb-item`, `breadcrumb-link`, `breadcrumb-page`, `breadcrumb-separator`, `breadcrumb-ellipsis`
- `progress` with `value` / `max` (RTL-friendly width fill)
- `kbd` and `kbd-group` for keyboard shortcuts
- `aspect-ratio` with CSS ratio presets
- Tooltip composition (Alpine): `tooltip`, `tooltip-trigger`, `tooltip-content` (progressive `label`; logical `side`)
- Collapsible composition (Alpine): `collapsible`, `collapsible-trigger`, `collapsible-content`
- Accordion composition (Alpine): `accordion`, `accordion-item`, `accordion-trigger`, `accordion-content` (`single` / `multiple`)
- Popover composition (Alpine): `popover`, `popover-trigger`, `popover-content` (progressive `content` slot; logical `side` / `align`)
- `toggle` two-state button (`default` / `outline`)
- Empty composition: `empty`, `empty-header`, `empty-media`, `empty-title`, `empty-description`, `empty-content` (progressive `title` / `description` / `media` / `actions`)
- Toggle group (Alpine): `toggle-group`, `toggle-group-item` (`single` / `multiple`)
- `slider` range input with styled track and thumb (Alpine)
- Pagination composition: `pagination`, `pagination-content`, `pagination-item`, `pagination-link`, `pagination-previous`, `pagination-next`, `pagination-ellipsis`
- Table composition: `table`, `table-header`, `table-body`, `table-footer`, `table-row`, `table-head`, `table-cell`, `table-caption`
- Hover card (Alpine): `hover-card`, `hover-card-trigger`, `hover-card-content`
- Nested `.light` theme islands so docs previews can force light mode inside a dark page (and the reverse) without leaking global `dark:` utilities
- Alert dialog (Alpine): `alert-dialog`, `alert-dialog-trigger`, `alert-dialog-content`, `alert-dialog-header`, `alert-dialog-footer`, `alert-dialog-title`, `alert-dialog-description`, `alert-dialog-action`, `alert-dialog-cancel`
- Sheet (Alpine): `sheet`, `sheet-trigger`, `sheet-content`, `sheet-header`, `sheet-footer`, `sheet-title`, `sheet-description`, `sheet-close` (logical `side`)
- `scroll-area` thin scrollbar viewport
- `button-group` connected button clusters (`horizontal` / `vertical`)
- Dropdown menu (Alpine): `dropdown-menu`, `dropdown-menu-trigger`, `dropdown-menu-content`, `dropdown-menu-item`, `dropdown-menu-label`, `dropdown-menu-separator`, `dropdown-menu-shortcut`
- Field composition helpers: `field`, `field-label`, `field-description`, `field-error`
- Progressive form ergonomics: `label` / `description` / `errorMessage` on `checkbox`, `radio`, `switch`, `input`, `textarea`, and `select` (compose the field helpers automatically, like `dark-mode-toggle` builds on `button`)
- `button` `loading` prop for forced/Alpine busy state (alongside Livewire `wire:loading` + `loadingText`)
- `dark-mode-toggle` component
- Radio group (Alpine): `radio-group`, `radio-group-item` (progressive label / description / errorMessage)
- `file-input` with progressive field composition
- Form layout: `form`, `form-item`
- `rating` star control (Alpine)
- Timeline composition: `timeline`, `timeline-item`, `timeline-indicator`, `timeline-content`, `timeline-title`, `timeline-description`
- Stepper composition (Alpine): `stepper`, `stepper-item`, `stepper-title`, `stepper-description`
- `marquee` CSS infinite scroll with pause-on-hover and reverse
- Drawer (Alpine): `drawer`, `drawer-trigger`, `drawer-content`, `drawer-header`, `drawer-footer`, `drawer-title`, `drawer-description`, `drawer-close` (default `side=bottom`)
- Carousel (Alpine): `carousel`, `carousel-content`, `carousel-item`, `carousel-previous`, `carousel-next`
- Resizable panels (Alpine): `resizable-panel-group`, `resizable-panel`, `resizable-handle`
- Context menu (Alpine): `context-menu`, `context-menu-trigger`, `context-menu-content`, `context-menu-item`, `context-menu-separator`, `context-menu-label`
- Command palette (Alpine): `command`, `command-input`, `command-list`, `command-empty`, `command-group`, `command-item`, `command-separator`
- Combobox (Alpine): `combobox`, `combobox-input`, `combobox-content`, `combobox-item`
- `calendar` month grid date picker (Alpine)
- Menubar (Alpine): `menubar`, `menubar-menu`, `menubar-trigger`, `menubar-content`, `menubar-item`, `menubar-separator`
- Navigation menu (Alpine): `navigation-menu`, `navigation-menu-list`, `navigation-menu-item`, `navigation-menu-trigger`, `navigation-menu-content`, `navigation-menu-link`
- Sidebar (Alpine): `sidebar-provider`, `sidebar`, `sidebar-header`, `sidebar-content`, `sidebar-footer`, `sidebar-menu`, `sidebar-menu-item`, `sidebar-menu-button`, `sidebar-inset`, `sidebar-trigger`
- `app-shell` layout with header, sidebar, and main slots
- Chart composition: `chart`, `chart-bar` (minimal CSS bar chart)
- `spotlight` mouse-following radial gradient (Alpine)
- Toast notifications (Alpine): `toaster`, `toast`, `toast-title`, `toast-description`, `toast-action`, `toast-close` (`slate-toast` window event; toaster teleports to `body`)
- Theme preference persisted in `localStorage` (`slate-theme`) and restored on load
- Sidebar theme tokens (`sidebar`, `sidebar-foreground`, `sidebar-accent`, `sidebar-border`, `sidebar-ring`)
- Overlay scroll-lock + focus cycle for `dialog`, `drawer`, `sheet`, and `alert-dialog`
- Slate-owned semantic theme tokens including `success`, `warning`, and `info`
- Livewire-aware validation and loading ergonomics for form controls
- Open source repository documentation and GitHub community templates

## 3.0.0-alpha.1

### Added

- Initial `3.x` rebuild foundation
- Package skeleton and service provider
- Slate-owned theme token system
- First shadcn-inspired `button` primitive
