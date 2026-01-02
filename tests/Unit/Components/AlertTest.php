<?php

namespace Electrik\Slate\Tests\Unit\Components;

use Electrik\Slate\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class AlertTest extends TestCase
{
    #[Test]
    public function it_renders_a_default_alert()
    {
        $view = $this->blade('<x-slate::alert>Alert message</x-slate::alert>');

        $view->assertSee('Alert message');
        $view->assertSee('rounded-lg');
        $view->assertSee('border');
        $view->assertSee('p-4');
        $view->assertSee('role="alert"', false);
    }

    #[Test]
    public function it_renders_alert_with_default_variant()
    {
        $view = $this->blade('<x-slate::alert variant="default">Default alert</x-slate::alert>');

        $view->assertSee('bg-background');
        $view->assertSee('text-foreground');
        $view->assertSee('border-border');
    }

    #[Test]
    public function it_renders_alert_with_success_variant()
    {
        $view = $this->blade('<x-slate::alert variant="success">Success message</x-slate::alert>');

        $view->assertSee('Success message');
        $view->assertSee('bg-success/10');
        $view->assertSee('text-success-foreground');
        $view->assertSee('border-success/20');
    }

    #[Test]
    public function it_renders_alert_with_warning_variant()
    {
        $view = $this->blade('<x-slate::alert variant="warning">Warning message</x-slate::alert>');

        $view->assertSee('Warning message');
        $view->assertSee('bg-warning/10');
        $view->assertSee('text-warning-foreground');
        $view->assertSee('border-warning/20');
    }

    #[Test]
    public function it_renders_alert_with_info_variant()
    {
        $view = $this->blade('<x-slate::alert variant="info">Info message</x-slate::alert>');

        $view->assertSee('Info message');
        $view->assertSee('bg-info/10');
        $view->assertSee('text-info-foreground');
        $view->assertSee('border-info/20');
    }

    #[Test]
    public function it_renders_alert_with_error_variant()
    {
        $view = $this->blade('<x-slate::alert variant="error">Error message</x-slate::alert>');

        $view->assertSee('Error message');
        $view->assertSee('bg-error/10');
        $view->assertSee('text-error-foreground');
        $view->assertSee('border-error/20');
    }

    #[Test]
    public function it_renders_alert_with_danger_variant()
    {
        $view = $this->blade('<x-slate::alert variant="danger">Danger message</x-slate::alert>');

        $view->assertSee('Danger message');
        $view->assertSee('bg-danger/10');
        $view->assertSee('text-danger-foreground');
        $view->assertSee('border-danger/20');
    }

    #[Test]
    public function it_renders_alert_with_title()
    {
        $view = $this->blade('<x-slate::alert>
            <x-slate::alert-title>Alert Title</x-slate::alert-title>
            Alert content
        </x-slate::alert>');

        $view->assertSee('Alert Title');
        $view->assertSee('Alert content');
    }

    #[Test]
    public function it_renders_alert_with_description()
    {
        $view = $this->blade('<x-slate::alert>
            <x-slate::alert-description>Alert description text</x-slate::alert-description>
        </x-slate::alert>');

        $view->assertSee('Alert description text');
        $view->assertSee('text-sm');
    }

    #[Test]
    public function it_renders_alert_with_title_and_description()
    {
        $view = $this->blade('<x-slate::alert>
            <x-slate::alert-title>Title</x-slate::alert-title>
            <x-slate::alert-description>Description</x-slate::alert-description>
        </x-slate::alert>');

        $view->assertSee('Title');
        $view->assertSee('Description');
    }

    #[Test]
    public function it_renders_alert_title_with_custom_tag()
    {
        $view = $this->blade('<x-slate::alert>
            <x-slate::alert-title as="h3">Custom Title</x-slate::alert-title>
        </x-slate::alert>');

        $view->assertSee('<h3', false);
        $view->assertSee('Custom Title');
    }

    #[Test]
    public function it_renders_alert_description_with_custom_tag()
    {
        $view = $this->blade('<x-slate::alert>
            <x-slate::alert-description as="p">Custom Description</x-slate::alert-description>
        </x-slate::alert>');

        $view->assertSee('<p', false);
        $view->assertSee('Custom Description');
    }

    #[Test]
    public function it_renders_alert_with_custom_classes()
    {
        $view = $this->blade('<x-slate::alert class="custom-alert">Alert</x-slate::alert>');

        $view->assertSee('custom-alert', false);
    }

    #[Test]
    public function it_renders_complete_alert_example()
    {
        $view = $this->blade('<x-slate::alert variant="success">
            <x-slate::alert-title>Success!</x-slate::alert-title>
            <x-slate::alert-description>Your changes have been saved.</x-slate::alert-description>
        </x-slate::alert>');

        $view->assertSee('Success!');
        $view->assertSee('Your changes have been saved.');
        $view->assertSee('bg-success/10');
        $view->assertSee('text-success-foreground');
    }

    #[Test]
    public function it_renders_alert_without_slots()
    {
        $view = $this->blade('<x-slate::alert></x-slate::alert>');

        $view->assertSee('role="alert"', false);
        $view->assertSee('rounded-lg');
    }

    #[Test]
    public function it_handles_invalid_variant_gracefully()
    {
        $view = $this->blade('<x-slate::alert variant="invalid">Alert</x-slate::alert>');

        // Should fall back to default variant
        $view->assertSee('Alert');
        $view->assertSee('bg-background');
    }

    #[Test]
    public function it_renders_alert_title_with_proper_styling()
    {
        $view = $this->blade('<x-slate::alert>
            <x-slate::alert-title>Title</x-slate::alert-title>
        </x-slate::alert>');

        $view->assertSee('font-medium');
        $view->assertSee('leading-none');
        $view->assertSee('tracking-tight');
    }

    #[Test]
    public function it_renders_alert_description_with_proper_styling()
    {
        $view = $this->blade('<x-slate::alert>
            <x-slate::alert-description>Description</x-slate::alert-description>
        </x-slate::alert>');

        $view->assertSee('text-sm');
        $view->assertSee('[&_p]:leading-relaxed');
    }
}

