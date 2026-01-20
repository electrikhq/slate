# Slate UI Kit

[![Latest Version](https://img.shields.io/packagist/v/electrik/slate.svg?style=flat-square)](https://packagist.org/packages/electrik/slate)
[![Total Downloads](https://img.shields.io/packagist/dt/electrik/slate.svg?style=flat-square)](https://packagist.org/packages/electrik/slate)
[![License](https://img.shields.io/packagist/l/electrik/slate.svg?style=flat-square)](https://packagist.org/packages/electrik/slate)
[![PHP Version](https://img.shields.io/packagist/php-v/electrik/slate.svg?style=flat-square)](https://packagist.org/packages/electrik/slate)
[![Laravel Version](https://img.shields.io/badge/Laravel-10.x%20%7C%2011.x%20%7C%2012.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![Tests](https://img.shields.io/github/actions/workflow/status/electrikhq/slate/.github/workflows/tests.yml?branch=2.x&label=tests&style=flat-square)](https://github.com/electrikhq/slate/actions)
[![Code Coverage](https://img.shields.io/badge/coverage-coming%20soon-lightgrey?style=flat-square)](https://github.com/electrikhq/slate)
[![Code Quality](https://img.shields.io/badge/code%20quality-coming%20soon-lightgrey?style=flat-square)](https://github.com/electrikhq/slate)
[![WCAG 2.1 AA](https://img.shields.io/badge/WCAG-2.1%20AA-4CAF50?style=flat-square&logo=accessibility&logoColor=white)](https://www.w3.org/WAI/WCAG21/quickref/?currentsidebar=%23col_customize&levels=aaa)
[![ARIA Support](https://img.shields.io/badge/ARIA-supported-4CAF50?style=flat-square&logo=accessibility&logoColor=white)](https://www.w3.org/WAI/ARIA/)
[![GitHub Stars](https://img.shields.io/github/stars/electrikhq/slate.svg?style=flat-square&label=stars)](https://github.com/electrikhq/slate)
[![GitHub Forks](https://img.shields.io/github/forks/electrikhq/slate.svg?style=flat-square&label=forks)](https://github.com/electrikhq/slate)
[![GitHub Issues](https://img.shields.io/github/issues/electrikhq/slate.svg?style=flat-square&label=issues)](https://github.com/electrikhq/slate/issues)
[![GitHub PRs](https://img.shields.io/github/issues-pr/electrikhq/slate.svg?style=flat-square&label=PRs)](https://github.com/electrikhq/slate/pulls)
[![Last Commit](https://img.shields.io/github/last-commit/electrikhq/slate/2.x.svg?style=flat-square&label=last%20commit)](https://github.com/electrikhq/slate)
[![Maintained](https://img.shields.io/maintenance/yes/2026.svg?style=flat-square&label=maintained)](https://github.com/electrikhq/slate)

**Slate** - a Laravel Blade UI Kit is a set of anonymous blade components built using [TailwindCSS](https://tailwindcss.com/) v4 with built-in dark mode support for your next [Laravel](https://laravel.com) project. Perfect for Laravel UI development with beautiful, accessible components.

![Slate UI Auth Login Screen Screenshot](https://i.postimg.cc/nV27DBj2/Electrik-Slate-Laravel-Blade-UI-Kit-Demo-Electrik-Laravel-Saa-S-Starter-Kit-Login-Screen.png)

[Demo](https://electrik.dev/demo/slate/forms) | [Documentation](https://electrik.dev/docs/slate/master)

## ✨ Features

- 🎨 **57 Components** - Complete component library
- 🎯 **Zero PHP Color Logic** - All colors controlled via CSS variables
- 🌙 **Dark Mode** - Built-in dark mode support with automatic variable switching
- ♿ **Accessible** - WCAG 2.1 AA compliant with proper ARIA attributes
- 🚀 **Tailwind CSS v4** - Using latest Tailwind with CSS variables
- 📦 **Anonymous Components** - Pure Blade templates, no PHP classes
- 🎨 **Self-Contained** - Everything in the package, minimal client configuration
- ⚡ **Alpine.js** - Interactive components using Alpine.js (standard in Laravel)
- 🎨 **Semantic Colors** - success, warning, info, error, danger color system

## 📋 Requirements

- PHP 8.1+
- Laravel 10.0+ or 11.0+ or 12.0+
- Tailwind CSS v4
- Alpine.js (for interactive components - usually included in Laravel apps)

## 🚀 Installation

### Step 1: Install via Composer

```bash
composer require electrik/slate
```

### Step 2: Run Installation Command

```bash
php artisan slate:install
```

This command will:
- Copy `slate.css` to `resources/css/slate.css`
- Add `@import './slate.css';` to your `app.css` (after `@import 'tailwindcss';`)
- Add `@source` directive to scan Slate components

**Note:** The installation command automatically configures your `app.css` file. No manual Tailwind config changes needed when using Tailwind CSS v4!

### Step 3: Build Assets

```bash
npm run build
```

That's it! Slate uses CSS variables and Tailwind v4's `@theme` system, so no `tailwind.config.js` changes are required.

## 📖 Usage

### Basic Example

```blade
<x-slate::button>Click me</x-slate::button>
```

### With Variants

```blade
<x-slate::button variant="success">Save</x-slate::button>
<x-slate::button variant="warning">Warning</x-slate::button>
<x-slate::button variant="error">Error</x-slate::button>
<x-slate::button variant="danger">Delete</x-slate::button>
<x-slate::button variant="outline">Cancel</x-slate::button>
<x-slate::button variant="ghost">Ghost Button</x-slate::button>
```

### Form Example

```blade
<x-slate::label for="email">Email</x-slate::label>
<x-slate::input type="email" id="email" name="email" placeholder="Enter your email" />
```

## 🎨 Components

Slate includes **57 components**:

### Core Components
- Button, Input, Card, Label, Badge

### Form Components
- Textarea, Select, Checkbox, Radio Group, Switch, Slider, Input Group, Input OTP, Field

### Feedback & Overlay
- Alert, Dialog, Alert Dialog, Drawer, Sheet, Popover, Tooltip, Hover Card, Sonner (Toast)

### Navigation
- Dropdown Menu, Context Menu, Navigation Menu, Menubar, Breadcrumb, Tabs, Sidebar, Pagination

### Data Display
- Table, Avatar, Separator, Skeleton, Empty, Aspect Ratio

### Advanced
- Accordion, Collapsible, Command, Combobox, Calendar, Progress, Scroll Area, Resizable, Carousel, Chart

### Utility
- Toggle, Toggle Group, Button Group, Item, Kbd, Spinner

## 🎨 Theming

### Color System

Slate uses semantic color naming with foreground/background pairs:

**Base Colors:**
- `background` / `foreground` - Page background and text
- `border`, `input`, `ring` - UI element colors

**Semantic Colors:**
- `primary` / `primary-foreground` - Main brand color
- `secondary` / `secondary-foreground` - Secondary actions
- `success` / `success-foreground` - Success states
- `warning` / `warning-foreground` - Warning states
- `info` / `info-foreground` - Informational states
- `error` / `error-foreground` - Error states
- `danger` / `danger-foreground` - Destructive actions
- `muted` / `muted-foreground` - Subtle backgrounds/text
- `accent` / `accent-foreground` - Hover states, highlights
- `card` / `card-foreground` - Card backgrounds
- `popover` / `popover-foreground` - Popover backgrounds

### Customize Colors

Override CSS variables in `resources/css/slate.css`:

```css
:root {
  --color-primary: 142 76% 36%; /* Custom green */
  --color-primary-foreground: 355 100% 97%;
  --color-success: 142 71% 45%; /* Custom success color */
  --color-success-foreground: 0 0% 98%;
}

.dark {
  --color-primary: 142 70% 45%; /* Dark mode variant */
  --color-primary-foreground: 0 0% 9%;
}
```

### Dark Mode

Dark mode is automatically handled via the `.dark` class:

```blade
<html class="dark">
  <!-- Dark mode enabled -->
</html>
```

Toggle dark mode with Alpine.js:

```blade
<div x-data="{ dark: false }">
  <button @click="dark = !dark; document.documentElement.classList.toggle('dark', dark)">
    Toggle Dark Mode
  </button>
</div>
```

## 🧪 Testing

Slate components are tested using:

- **Unit Tests** - Blade component rendering with different props/variants
- **Integration Tests** - Components in real Laravel views and forms
- **Visual Regression Tests**
- **Accessibility Tests** - WCAG 2.1 AA compliance using axe-core/Pa11y

## 📚 Documentation

Full documentation is available at: [https://slate.electrik.dev](https://slate.electrik.dev)

**Note:** Documentation is in a separate repository (`slate-docs`) and uses Jigsaw for static site generation.

## 🔧 Customization

### Self-Contained Package

Slate is designed to be self-contained. All styles and components live in the package, and the `slate:install` command handles configuration automatically.

### Customize CSS Variables

Edit `resources/css/slate.css` (copied during installation) to customize colors, spacing, and other design tokens.

### Publish Views (Optional)

To customize component markup:

```bash
php artisan vendor:publish --tag=slate-views
```

Views will be published to `resources/views/vendor/slate/components/`

**Note:** Published views won't receive automatic updates. Use this only if you need to modify component structure.

## 🤝 Contributing

Contributions are welcome! Please see our [Contributing Guide](CONTRIBUTING.md) for details.

## 📄 License

This package is open-sourced software licensed under the [MIT license](LICENSE).

## 🙏 Credits

- Built with [Laravel](https://laravel.com) and [Tailwind CSS](https://tailwindcss.com)
- Interactive components powered by [Alpine.js](https://alpinejs.dev/)

---

Made with ❤️ by [Electrik](https://electrik.dev)
