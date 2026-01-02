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
                'label',
                'badge',
                // More components will be added as we build them
            ];

            foreach ($components as $component) {
                $blade->component("slate::components.{$component}", "slate::{$component}");
            }
        });
    }
}
