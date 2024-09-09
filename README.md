# Slate

Slate UI Kit is a set of beautiful anonymous blade components built using [tailwindcss](https://tailwindcss.com/) for your next [Laravel](https://laravel.com) project.

![Slate UI Auth Login Screen Screenshot](https://i.postimg.cc/nV27DBj2/Electrik-Slate-Laravel-Blade-UI-Kit-Demo-Electrik-Laravel-Saa-S-Starter-Kit-Login-Screen.png)

[Demo](https://electrik.dev/demo/slate/forms) | [Documentation](https://electrik.dev/docs/slate/master)

## Requirements

* PHP 7.4+
* Laravel 7+
* Tailwindcss

Slate UI kit is entirely dependent on Tailwind CSS. If you are using another CSS framework, conflicts may occur. It is not advised to use this kit with any other CSS framework

## Installation

**Start by installing the package using composer.**

```bash
composer require electrik/slate
```

Many of our components have (and will have) placeholders for icons. For these icons, we use blade [blade-carbon-icons](https://github.com/codeat3/blade-carbon-icons). You may use other icon sets available here - [blade-icons](https://github.com/blade-ui-kit/blade-icons).

**Install Tailwind CSS**

```bash
npm install @tailwindcss/aspect-ratio @tailwindcss/forms @tailwindcss/typography --save-dev
```

## Setup

In your Laravel's root tailwind.config.js file, require the plugins we installed as shown below:

```js
{
...
plugins: [
        require('@tailwindcss/aspect-ratio'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
...
}
```

Next, your should define the a color scheme for your project:

```js
{
...
theme: {
        extend: {
            colors: {
                danger: colors.rose,
                primary: colors.blue,
                success: colors.green,
                warning: colors.yellow,
            },
            fontFamily: {
                sans: ['Inter', ...fontFamily.sans],
            },
        },
    },
...
}
```

Your final tailwind.config.js should look like this:

```js
const colors = require('tailwindcss/colors')
const { fontFamily } = require('tailwindcss/defaultTheme')

module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './vendor/electrik/slate/resources/views/components/**/*.blade.php',
        './vendor/electrik/slate/src/Helpers/SlateUiHelper.php',
    ],
    theme: {
        extend: {
            colors: {
                danger: colors.rose,
                primary: colors.blue,
                success: colors.green,
                warning: colors.yellow,
            },
            fontFamily: {
                sans: ['Inter', ...fontFamily.sans],
            },
        },
    },
    plugins: [
        require('@tailwindcss/aspect-ratio'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}

```

## Start Using

Once installed you can start using the UI kit in your Laravel views.

For example, for badge using the following will generate badges

```blade
<x-slate::badge color="success" size="xs">xs badge</x-slate::badge> 
<x-slate::badge color="success" size="sm">small badge</x-slate::badge> 
<x-slate::badge color="success" size="lg">large badge</x-slate::badge> 
```
