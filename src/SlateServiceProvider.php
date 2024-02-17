<?php

namespace Slate\Slate;

use Illuminate\Support\ServiceProvider;

class SlateServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'slate');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/slate'),
        ]);
    }
}