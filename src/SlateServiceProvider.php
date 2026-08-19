<?php

namespace Electrik\Slate;

use Illuminate\Support\ServiceProvider;

class SlateServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'slate');
    }
}
