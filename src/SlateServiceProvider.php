<?php

namespace Electrik\Slate;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class SlateServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register config
        $this->mergeConfigFrom(
            __DIR__ . '/../config/slate.php',
            'slate'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Publish config
        $this->publishes([
            __DIR__ . '/../config/slate.php' => config_path('slate.php'),
        ], 'slate-config');

        // Publish views (optional, for customization)
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/slate'),
        ], 'slate-views');

        // Publish CSS
        $this->publishes([
            __DIR__ . '/../resources/css/slate.css' => resource_path('css/slate.css'),
        ], 'slate-css');

        // Load views from package
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'slate');

        // Register Blade components
        $this->loadBladeComponents();

        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\InstallCommand::class,
            ]);
        }
    }

    /**
     * Register anonymous Blade components.
     */
    protected function loadBladeComponents(): void
    {
        $this->callAfterResolving('blade.compiler', function (BladeCompiler $blade) {
            // List of all components to register
            $components = [
                'button',
                'input',
                'input-group',
                'input-otp',
                'textarea',
                'select',
                'checkbox',
                'radio',
                'radio-group',
                'switch',
                'slider',
                'field',
                'card',
                'card-header',
                'card-title',
                'card-description',
                'card-content',
                'card-footer',
                'alert',
                'alert-title',
                'alert-description',
                'dialog',
                'dialog-trigger',
                'dialog-content',
                'dialog-header',
                'dialog-footer',
                'dialog-title',
                'dialog-description',
                'dialog-close',
                'dialog-overlay',
                'alert-dialog',
                'alert-dialog-trigger',
                'alert-dialog-content',
                'alert-dialog-header',
                'alert-dialog-footer',
                'alert-dialog-title',
                'alert-dialog-description',
                'alert-dialog-action',
                'alert-dialog-cancel',
                'alert-dialog-overlay',
                'drawer',
                'drawer-trigger',
                'drawer-content',
                'drawer-header',
                'drawer-footer',
                'drawer-title',
                'drawer-description',
                'drawer-close',
                'drawer-overlay',
                'popover',
                'popover-trigger',
                'popover-content',
                'tooltip',
                'tooltip-trigger',
                'tooltip-content',
                'hover-card',
                'hover-card-trigger',
                'hover-card-content',
                'dropdown-menu',
                'dropdown-menu-trigger',
                'dropdown-menu-content',
                'dropdown-menu-item',
                'dropdown-menu-separator',
                'dropdown-menu-label',
                'context-menu',
                'context-menu-trigger',
                'context-menu-content',
                'context-menu-item',
                'context-menu-separator',
                'context-menu-label',
                'navigation-menu',
                'navigation-menu-list',
                'navigation-menu-item',
                'navigation-menu-trigger',
                'navigation-menu-content',
                'navigation-menu-link',
                'navigation-menu-viewport',
                'menubar',
                'menubar-menu',
                'menubar-trigger',
                'menubar-content',
                'menubar-item',
                'menubar-separator',
                'menubar-shortcut',
                'breadcrumb',
                'breadcrumb-list',
                'breadcrumb-item',
                'breadcrumb-link',
                'breadcrumb-page',
                'breadcrumb-separator',
                'breadcrumb-ellipsis',
                'pagination',
                'pagination-content',
                'pagination-item',
                'pagination-link',
                'pagination-ellipsis',
                'pagination-previous',
                'pagination-next',
                'command',
                'command-dialog',
                'command-input',
                'command-list',
                'command-empty',
                'command-group',
                'command-item',
                'command-separator',
                'command-shortcut',
                'combobox',
                'combobox-trigger',
                'combobox-input',
                'combobox-content',
                'combobox-item',
                'combobox-empty',
                'table',
                'table-header',
                'table-body',
                'table-footer',
                'table-row',
                'table-head',
                'table-cell',
                'table-caption',
                'avatar',
                'avatar-image',
                'avatar-fallback',
                'separator',
                'skeleton',
                'empty',
                'aspect-ratio',
                'accordion',
                'accordion-item',
                'accordion-trigger',
                'accordion-content',
                'collapsible',
                'collapsible-trigger',
                'collapsible-content',
                'calendar',
                'calendar-header',
                'calendar-title',
                'calendar-nav',
                'calendar-grid',
                'progress',
                'scroll-area',
                'resizable',
                'resizable-panel',
                'resizable-handle',
                'carousel',
                'carousel-content',
                'carousel-item',
                'carousel-previous',
                'carousel-next',
                'carousel-indicators',
                'chart',
                'chart-legend',
                'chart-legend-item',
                'spinner',
                'tabs',
                'tabs-list',
                'tabs-trigger',
                'tabs-content',
                'tabs-panel',
                'label',
                'badge',
                'toast',
                'toaster',
                'toast-action',
                'toast-close',
                'toggle',
                'toggle-group',
                'toggle-group-item',
                'form',
                'kbd',
                'sheet',
                'sheet-trigger',
                'sheet-overlay',
                'sheet-content',
                'sheet-header',
                'sheet-footer',
                'sheet-title',
                'sheet-description',
                'sheet-close',
                'sidebar',
                'sidebar-trigger',
                'sidebar-header',
                'sidebar-content',
                'sidebar-footer',
                'sidebar-group',
                'sidebar-group-label',
                'sidebar-menu',
                'sidebar-menu-item',
                'sidebar-menu-button',
                'stepper',
                'step',
                'step-separator',
                'timeline',
                'timeline-item',
                'timeline-content',
                'timeline-title',
                'timeline-description',
                'timeline-time',
                'marquee',
                'rating',
                'spotlight',
                'spotlight-trigger',
                'spotlight-overlay',
                'spotlight-content',
                'spotlight-item',
                'spotlight-group',
                'spotlight-empty',
                'switch',
                'switch-label',
                'switch-description',
                'switch-group',
                'separator',
                'skeleton',
                'slider',
                'slider-track',
                'slider-range',
                'slider-thumb',
                'radio-group',
                'radio-group-item',
                'checkbox',
                'checkbox-label',
                'select',
                'select-trigger',
                'select-content',
                'select-item',
                'select-group',
                'select-separator',
                'file-input',
                'app-shell',
                'app-shell-sidebar',
                'app-shell-header',
                'app-shell-footer',
                // More components will be added as we build them
            ];

            foreach ($components as $component) {
                $blade->component("slate::components.{$component}", "slate::{$component}");
            }
        });
    }
}
