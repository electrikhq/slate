# Slate UI Kit

[![Latest Version](https://img.shields.io/packagist/v/electrik/slate.svg?style=flat-square)](https://packagist.org/packages/electrik/slate)
[![Total Downloads](https://img.shields.io/packagist/dt/electrik/slate.svg?style=flat-square)](https://packagist.org/packages/electrik/slate)
[![License](https://img.shields.io/packagist/l/electrik/slate.svg?style=flat-square)](https://packagist.org/packages/electrik/slate)
[![PHP Version](https://img.shields.io/packagist/php-v/electrik/slate.svg?style=flat-square)](https://packagist.org/packages/electrik/slate)
[![Laravel Version](https://img.shields.io/badge/Laravel-12.x%20%7C%2013.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![GitHub Stars](https://img.shields.io/github/stars/electrikhq/slate.svg?style=flat-square&label=stars)](https://github.com/electrikhq/slate)
[![GitHub Issues](https://img.shields.io/github/issues/electrikhq/slate.svg?style=flat-square&label=issues)](https://github.com/electrikhq/slate/issues)
[![Last Commit](https://img.shields.io/github/last-commit/electrikhq/slate/3.x.svg?style=flat-square&label=last%20commit)](https://github.com/electrikhq/slate)
[![Maintained](https://img.shields.io/maintenance/yes/2026.svg?style=flat-square&label=maintained)](https://github.com/electrikhq/slate)

**Slate** is a shadcn-inspired Laravel Blade UI kit built with anonymous components, Tailwind CSS v4, Slate-owned theme tokens, and first-class dark mode support.

The `3.x` line is a clean rebuild focused on visual quality, customization power, and Laravel-native ergonomics.

[Documentation](https://slate.electrik.dev) | [AI & MCP](https://slate.electrik.dev/docs/ai) | [Issues](https://github.com/electrikhq/slate/issues) | [Discussions](https://github.com/electrikhq/slate/discussions)

## Features

- Anonymous Blade components only
- Tailwind CSS v4 with Slate-owned CSS tokens
- Full theme customization via CSS variables
- Built-in dark mode support
- Livewire-aware form primitives
- Accessible defaults with ARIA and validation wiring
- Static-first primitives with room for Alpine-powered interactive components later
- AI-ready docs (`llms.txt`), read-only MCP server, and Cursor / AGENTS guidance

## Requirements

- PHP 8.3+
- Laravel 12.x or 13.x
- Tailwind CSS v4
- Alpine.js for interactive components such as `dark-mode-toggle`, `dialog`, `tabs`, `tooltip`, `collapsible`, `accordion`, `popover`, `toggle`, `toggle-group`, `slider`, `hover-card`, `alert-dialog`, `sheet`, `dropdown-menu`, `drawer`, `carousel`, `resizable`, `context-menu`, `command`, `combobox`, `calendar`, `menubar`, `navigation-menu`, `sidebar`, `rating`, `radio-group`, `spotlight`, and `toast` / `toaster`

## Installation

Install the package:

```bash
composer require electrik/slate
```

Import Slate styles in your app CSS after Tailwind:

```css
@import 'tailwindcss';
@import '../../vendor/electrik/slate/resources/css/slate.css';
```

Build your assets:

```bash
npm run build
```

Slate ships with an embedded `@source` directive in `slate.css`, so component classes are discovered automatically once the package CSS is imported.

## Usage

Basic button:

```blade
<x-slate::button>Save</x-slate::button>
```

Form field composition:

```blade
<x-slate::field name="email">
    <x-slate::field-label for="email">Email</x-slate::field-label>
    <x-slate::input id="email" type="email" wire:model="email" />
    <x-slate::field-description>We will never share your email.</x-slate::field-description>
    <x-slate::field-error name="email" />
</x-slate::field>
```

Or the progressive prop API (builds on the same field helpers):

```blade
<x-slate::input
    label="Email"
    type="email"
    wire:model="email"
    description="We will never share your email."
/>

<x-slate::checkbox
    label="Product updates"
    description="Receive occasional release notes by email."
/>
```

Dark mode toggle:

```blade
<x-slate::dark-mode-toggle />
```

Card composition:

```blade
<x-slate::card class="w-full max-w-sm">
    <x-slate::card-header>
        <x-slate::card-title>Account</x-slate::card-title>
        <x-slate::card-description>Manage your workspace settings.</x-slate::card-description>
    </x-slate::card-header>
    <x-slate::card-content>
        ...
    </x-slate::card-content>
    <x-slate::card-footer class="justify-end gap-2 border-t">
        <x-slate::button variant="outline">Cancel</x-slate::button>
        <x-slate::button>Save</x-slate::button>
    </x-slate::card-footer>
</x-slate::card>
```

## Current Components

The `3.x` rebuild currently includes:

- `button`
- `badge`
- `card`, `card-header`, `card-title`, `card-description`, `card-action`, `card-content`, `card-footer`
- `alert`, `alert-title`, `alert-description`, `alert-action`
- `separator`
- `avatar`, `avatar-image`, `avatar-fallback`, `avatar-badge`, `avatar-group`, `avatar-group-count`
- `skeleton`
- `dialog`, `dialog-trigger`, `dialog-content`, `dialog-header`, `dialog-footer`, `dialog-title`, `dialog-description`, `dialog-close`
- `tabs`, `tabs-list`, `tabs-trigger`, `tabs-content`
- `spinner`
- `breadcrumb`, `breadcrumb-list`, `breadcrumb-item`, `breadcrumb-link`, `breadcrumb-page`, `breadcrumb-separator`, `breadcrumb-ellipsis`
- `progress`
- `kbd`, `kbd-group`
- `aspect-ratio`
- `tooltip`, `tooltip-trigger`, `tooltip-content`
- `collapsible`, `collapsible-trigger`, `collapsible-content`
- `accordion`, `accordion-item`, `accordion-trigger`, `accordion-content`
- `popover`, `popover-trigger`, `popover-content`
- `toggle`
- `toggle-group`, `toggle-group-item`
- `empty`, `empty-header`, `empty-media`, `empty-title`, `empty-description`, `empty-content`
- `slider`
- `pagination`, `pagination-content`, `pagination-item`, `pagination-link`, `pagination-previous`, `pagination-next`, `pagination-ellipsis`
- `table`, `table-header`, `table-body`, `table-footer`, `table-row`, `table-head`, `table-cell`, `table-caption`
- `hover-card`, `hover-card-trigger`, `hover-card-content`
- `alert-dialog`, `alert-dialog-trigger`, `alert-dialog-content`, `alert-dialog-header`, `alert-dialog-footer`, `alert-dialog-title`, `alert-dialog-description`, `alert-dialog-action`, `alert-dialog-cancel`
- `sheet`, `sheet-trigger`, `sheet-content`, `sheet-header`, `sheet-footer`, `sheet-title`, `sheet-description`, `sheet-close`
- `scroll-area`
- `button-group`
- `dropdown-menu`, `dropdown-menu-trigger`, `dropdown-menu-content`, `dropdown-menu-item`, `dropdown-menu-label`, `dropdown-menu-separator`, `dropdown-menu-shortcut`
- `input`
- `textarea`
- `select`
- `checkbox`
- `switch`
- `radio`
- `dark-mode-toggle`
- `field`
- `field-label`
- `field-description`
- `field-error`
- `radio-group`, `radio-group-item`
- `file-input`
- `form`, `form-item`
- `rating`
- `timeline`, `timeline-item`, `timeline-indicator`, `timeline-content`, `timeline-title`, `timeline-description`
- `stepper`, `stepper-item`, `stepper-title`, `stepper-description`
- `marquee`
- `drawer`, `drawer-trigger`, `drawer-content`, `drawer-header`, `drawer-footer`, `drawer-title`, `drawer-description`, `drawer-close`
- `carousel`, `carousel-content`, `carousel-item`, `carousel-previous`, `carousel-next`
- `resizable-panel-group`, `resizable-panel`, `resizable-handle`
- `context-menu`, `context-menu-trigger`, `context-menu-content`, `context-menu-item`, `context-menu-separator`, `context-menu-label`
- `command`, `command-input`, `command-list`, `command-empty`, `command-group`, `command-item`, `command-separator`
- `combobox`, `combobox-input`, `combobox-content`, `combobox-item`
- `calendar`
- `menubar`, `menubar-menu`, `menubar-trigger`, `menubar-content`, `menubar-item`, `menubar-separator`
- `navigation-menu`, `navigation-menu-list`, `navigation-menu-item`, `navigation-menu-trigger`, `navigation-menu-content`, `navigation-menu-link`
- `sidebar-provider`, `sidebar`, `sidebar-header`, `sidebar-content`, `sidebar-footer`, `sidebar-menu`, `sidebar-menu-item`, `sidebar-menu-button`, `sidebar-inset`, `sidebar-trigger`
- `app-shell`
- `chart`, `chart-bar`
- `spotlight`
- `toaster`, `toast`, `toast-title`, `toast-description`, `toast-action`, `toast-close`

The `3.x` alpha surface set is complete. Further work focuses on depth (richer calendar/combobox/chart behavior), accessibility hardening, and polish — not adding stub component names.

## Theming

Slate uses Slate-owned tokens such as `--slate-primary`, `--slate-background`, and `--slate-destructive`, mapped into Tailwind theme aliases in `resources/css/slate.css`.

Override tokens in your app:

```css
:root {
    --slate-primary: oklch(0.205 0 0);
    --slate-radius: 0.625rem;
}

.dark {
    --slate-primary: oklch(0.922 0 0);
}
```

Semantic tokens such as `success`, `warning`, and `info` are also available for future alert, badge, and status surfaces.

## Development

This package is developed as a Laravel library. A local consumer app can link it with a Composer path repository:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "../slate",
            "options": {
                "symlink": true
            }
        }
    ]
}
```

## Contributing

Contributions are welcome. Please read [CONTRIBUTING.md](CONTRIBUTING.md) before opening a pull request.

## Security

If you discover a security issue, please follow the process in [SECURITY.md](SECURITY.md).

## License

MIT. See [LICENSE](LICENSE).

---

Made with care by [Electrik](https://electrik.dev)
