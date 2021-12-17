# Slate UI Kit

[![Latest Version](https://img.shields.io/packagist/v/electrik/slate.svg?style=flat-square)](https://packagist.org/packages/electrik/slate)
[![Total Downloads](https://img.shields.io/packagist/dt/electrik/slate.svg?style=flat-square)](https://packagist.org/packages/electrik/slate)

Slate UI Kit is a set of beautiful anonymous blade components built using [tailwindcss](https://tailwindcss.com/) for your next [Laravel](https://laravel.com) project.

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
