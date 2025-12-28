<?php

namespace Electrik\Slate\Tests\Unit\Components;

use Electrik\Slate\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class BadgeTest extends TestCase
{
    #[Test]
    public function it_renders_a_default_badge()
    {
        $view = $this->blade('<x-slate::badge>Badge</x-slate::badge>');

        $view->assertSee('Badge');
        $view->assertSee('<span', false);
        $view->assertSee('bg-primary');
        $view->assertSee('text-primary-foreground');
        $view->assertSee('rounded-full');
        $view->assertSee('px-2.5');
        $view->assertSee('py-0.5');
        $view->assertSee('text-xs');
    }

    #[Test]
    public function it_renders_badge_with_success_variant()
    {
        $view = $this->blade('<x-slate::badge variant="success">Success</x-slate::badge>');

        $view->assertSee('Success');
        $view->assertSee('bg-success');
        $view->assertSee('text-success-foreground');
    }

    #[Test]
    public function it_renders_badge_with_warning_variant()
    {
        $view = $this->blade('<x-slate::badge variant="warning">Warning</x-slate::badge>');

        $view->assertSee('Warning');
        $view->assertSee('bg-warning');
        $view->assertSee('text-warning-foreground');
    }

    #[Test]
    public function it_renders_badge_with_info_variant()
    {
        $view = $this->blade('<x-slate::badge variant="info">Info</x-slate::badge>');

        $view->assertSee('Info');
        $view->assertSee('bg-info');
        $view->assertSee('text-info-foreground');
    }

    #[Test]
    public function it_renders_badge_with_error_variant()
    {
        $view = $this->blade('<x-slate::badge variant="error">Error</x-slate::badge>');

        $view->assertSee('Error');
        $view->assertSee('bg-error');
        $view->assertSee('text-error-foreground');
    }

    #[Test]
    public function it_renders_badge_with_danger_variant()
    {
        $view = $this->blade('<x-slate::badge variant="danger">Danger</x-slate::badge>');

        $view->assertSee('Danger');
        $view->assertSee('bg-danger');
        $view->assertSee('text-danger-foreground');
    }

    #[Test]
    public function it_renders_badge_with_secondary_variant()
    {
        $view = $this->blade('<x-slate::badge variant="secondary">Secondary</x-slate::badge>');

        $view->assertSee('Secondary');
        $view->assertSee('bg-secondary');
        $view->assertSee('text-secondary-foreground');
    }

    #[Test]
    public function it_renders_badge_with_outline_variant()
    {
        $view = $this->blade('<x-slate::badge variant="outline">Outline</x-slate::badge>');

        $view->assertSee('Outline');
        $view->assertSee('border-border');
        $view->assertSee('text-foreground');
        $view->assertDontSee('bg-primary');
    }

    #[Test]
    public function it_renders_small_badge()
    {
        $view = $this->blade('<x-slate::badge size="sm">Small</x-slate::badge>');

        $view->assertSee('Small');
        $view->assertSee('px-2');
        $view->assertSee('py-0.5');
        $view->assertSee('text-xs');
    }

    #[Test]
    public function it_renders_large_badge()
    {
        $view = $this->blade('<x-slate::badge size="lg">Large</x-slate::badge>');

        $view->assertSee('Large');
        $view->assertSee('px-3');
        $view->assertSee('py-1');
        $view->assertSee('text-sm');
    }

    #[Test]
    public function it_renders_default_size_badge()
    {
        $view = $this->blade('<x-slate::badge size="default">Default</x-slate::badge>');

        $view->assertSee('Default');
        $view->assertSee('px-2.5');
        $view->assertSee('py-0.5');
        $view->assertSee('text-xs');
    }

    #[Test]
    public function it_renders_badge_with_custom_attributes()
    {
        $view = $this->blade('<x-slate::badge class="custom-class" id="my-badge">Custom</x-slate::badge>');

        $view->assertSee('Custom');
        $view->assertSee('custom-class', false);
        $view->assertSee('id="my-badge"', false);
    }

    #[Test]
    public function it_renders_badge_with_focus_classes()
    {
        $view = $this->blade('<x-slate::badge>Focus</x-slate::badge>');

        $view->assertSee('focus:outline-none');
        $view->assertSee('focus:ring-2');
        $view->assertSee('focus:ring-ring');
        $view->assertSee('focus:ring-offset-2');
    }

    #[Test]
    public function it_renders_badge_with_transition_classes()
    {
        $view = $this->blade('<x-slate::badge>Transition</x-slate::badge>');

        $view->assertSee('transition-colors');
    }

    #[Test]
    public function it_renders_badge_with_hover_states()
    {
        $view = $this->blade('<x-slate::badge variant="success">Hover</x-slate::badge>');

        $view->assertSee('hover:bg-success/80');
    }

    #[Test]
    public function it_renders_badge_with_border_transparent_for_solid_variants()
    {
        $view = $this->blade('<x-slate::badge variant="default">Default</x-slate::badge>');

        $view->assertSee('border-transparent');
    }

    #[Test]
    public function it_renders_badge_with_border_for_outline_variant()
    {
        $view = $this->blade('<x-slate::badge variant="outline">Outline</x-slate::badge>');

        $view->assertSee('border-border');
        $view->assertDontSee('border-transparent');
    }

    #[Test]
    public function it_uses_semantic_html_element()
    {
        $view = $this->blade('<x-slate::badge>Badge</x-slate::badge>');

        // Badge should use <span> element (non-interactive)
        $view->assertSee('<span', false);
        $view->assertDontSee('<button', false);
        $view->assertDontSee('<a', false);
    }
}

