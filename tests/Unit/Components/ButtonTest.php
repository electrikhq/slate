<?php

namespace Electrik\Slate\Tests\Unit\Components;

use Electrik\Slate\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ButtonTest extends TestCase
{
    #[Test]
    public function it_renders_a_default_button()
    {
        $view = $this->blade('<x-slate::button>Click me</x-slate::button>');

        $view->assertSee('Click me');
        $view->assertSee('bg-primary');
        $view->assertSee('text-primary-foreground');
        $view->assertSee('hover:bg-primary/90');
    }

    #[Test]
    public function it_renders_button_with_success_variant()
    {
        $view = $this->blade('<x-slate::button variant="success">Save</x-slate::button>');

        $view->assertSee('Save');
        $view->assertSee('bg-success');
        $view->assertSee('text-success-foreground');
        $view->assertSee('hover:bg-success/90');
    }

    #[Test]
    public function it_renders_button_with_warning_variant()
    {
        $view = $this->blade('<x-slate::button variant="warning">Warning</x-slate::button>');

        $view->assertSee('Warning');
        $view->assertSee('bg-warning');
        $view->assertSee('text-warning-foreground');
    }

    #[Test]
    public function it_renders_button_with_error_variant()
    {
        $view = $this->blade('<x-slate::button variant="error">Error</x-slate::button>');

        $view->assertSee('Error');
        $view->assertSee('bg-error');
        $view->assertSee('text-error-foreground');
    }

    #[Test]
    public function it_renders_button_with_danger_variant()
    {
        $view = $this->blade('<x-slate::button variant="danger">Delete</x-slate::button>');

        $view->assertSee('Delete');
        $view->assertSee('bg-danger');
        $view->assertSee('text-danger-foreground');
    }

    #[Test]
    public function it_renders_button_with_outline_variant()
    {
        $view = $this->blade('<x-slate::button variant="outline">Cancel</x-slate::button>');

        $view->assertSee('Cancel');
        $view->assertSee('border');
        $view->assertSee('border-input');
        $view->assertSee('bg-background');
    }

    #[Test]
    public function it_renders_button_with_ghost_variant()
    {
        $view = $this->blade('<x-slate::button variant="ghost">Ghost</x-slate::button>');

        $view->assertSee('Ghost');
        $view->assertSee('hover:bg-accent');
        $view->assertSee('hover:text-accent-foreground');
    }

    #[Test]
    public function it_renders_button_with_secondary_variant()
    {
        $view = $this->blade('<x-slate::button variant="secondary">Secondary</x-slate::button>');

        $view->assertSee('Secondary');
        $view->assertSee('bg-secondary');
        $view->assertSee('text-secondary-foreground');
    }

    #[Test]
    public function it_renders_small_button()
    {
        $view = $this->blade('<x-slate::button size="sm">Small</x-slate::button>');

        $view->assertSee('Small');
        $view->assertSee('h-9');
        $view->assertSee('px-3');
        $view->assertSee('text-sm');
    }

    #[Test]
    public function it_renders_large_button()
    {
        $view = $this->blade('<x-slate::button size="lg">Large</x-slate::button>');

        $view->assertSee('Large');
        $view->assertSee('h-11');
        $view->assertSee('px-8');
    }

    #[Test]
    public function it_renders_default_size_button()
    {
        $view = $this->blade('<x-slate::button size="default">Default</x-slate::button>');

        $view->assertSee('Default');
        $view->assertSee('h-10');
        $view->assertSee('px-4');
    }

    #[Test]
    public function it_renders_disabled_button()
    {
        $view = $this->blade('<x-slate::button disabled>Disabled</x-slate::button>');

        $view->assertSee('Disabled');
        $view->assertSee('disabled');
        $view->assertSee('opacity-50');
        $view->assertSee('pointer-events-none');
    }

    #[Test]
    public function it_renders_button_with_custom_type()
    {
        $view = $this->blade('<x-slate::button type="submit">Submit</x-slate::button>');

        $view->assertSee('Submit');
        $view->assertSee('type="submit"', false);
    }

    #[Test]
    public function it_renders_button_with_custom_attributes()
    {
        $view = $this->blade('<x-slate::button class="custom-class" id="my-button">Custom</x-slate::button>');

        $view->assertSee('Custom');
        $view->assertSee('id="my-button"', false);
        // Custom class should be merged with component classes
        $view->assertSee('custom-class', false);
    }

    #[Test]
    public function it_renders_button_with_focus_visible_classes()
    {
        $view = $this->blade('<x-slate::button>Focus</x-slate::button>');

        $view->assertSee('focus-visible:outline-none');
        $view->assertSee('focus-visible:ring-2');
        $view->assertSee('focus-visible:ring-ring');
    }
}

