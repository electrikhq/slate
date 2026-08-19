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

[Documentation](https://slate.electrik.dev) | [Issues](https://github.com/electrikhq/slate/issues) | [Discussions](https://github.com/electrikhq/slate/discussions)

## Features

- Anonymous Blade components only
- Tailwind CSS v4 with Slate-owned CSS tokens
- Full theme customization via CSS variables
- Built-in dark mode support
- Livewire-aware form primitives
- Accessible defaults with ARIA and validation wiring
- Static-first primitives with room for Alpine-powered interactive components later

## Requirements

- PHP 8.3+
- Laravel 12.x or 13.x
- Tailwind CSS v4
- Alpine.js for interactive components such as `dark-mode-toggle`

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

Dark mode toggle:

```blade
<x-slate::dark-mode-toggle />
```

## Current Components

The `3.x` rebuild currently includes:

- `button`
- `input`
- `textarea`
- `select`
- `checkbox`
- `switch`
- `dark-mode-toggle`
- `field`
- `field-label`
- `field-description`
- `field-error`

More primitives and interactive components will land incrementally on `3.x`.

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
