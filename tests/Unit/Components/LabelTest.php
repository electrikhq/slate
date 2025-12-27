<?php

namespace Electrik\Slate\Tests\Unit\Components;

use Electrik\Slate\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class LabelTest extends TestCase
{
    #[Test]
    public function it_renders_a_default_label()
    {
        $view = $this->blade('<x-slate::label>Email</x-slate::label>');

        $view->assertSee('Email');
        $view->assertSee('<label', false);
        $view->assertSee('text-sm');
        $view->assertSee('font-medium');
        $view->assertSee('leading-none');
    }

    #[Test]
    public function it_renders_label_with_for_attribute()
    {
        $view = $this->blade('<x-slate::label for="email">Email</x-slate::label>');

        $view->assertSee('Email');
        $view->assertSee('for="email"', false);
    }

    #[Test]
    public function it_renders_required_label_with_asterisk()
    {
        $view = $this->blade('<x-slate::label required>Email</x-slate::label>');

        $view->assertSee('Email');
        $view->assertSee('after:content-["*"]');
        $view->assertSee('after:text-danger');
    }

    #[Test]
    public function it_renders_label_with_error_state()
    {
        $view = $this->blade('<x-slate::label error>Email</x-slate::label>');

        $view->assertSee('Email');
        $view->assertSee('text-danger');
        $view->assertDontSee('text-foreground');
    }

    #[Test]
    public function it_renders_small_label()
    {
        $view = $this->blade('<x-slate::label size="sm">Email</x-slate::label>');

        $view->assertSee('Email');
        $view->assertSee('text-xs');
        $view->assertDontSee('text-sm');
    }

    #[Test]
    public function it_renders_large_label()
    {
        $view = $this->blade('<x-slate::label size="lg">Email</x-slate::label>');

        $view->assertSee('Email');
        $view->assertSee('text-base');
        $view->assertDontSee('text-sm');
    }

    #[Test]
    public function it_renders_default_size_label()
    {
        $view = $this->blade('<x-slate::label size="default">Email</x-slate::label>');

        $view->assertSee('Email');
        $view->assertSee('text-sm');
    }

    #[Test]
    public function it_renders_label_with_peer_disabled_classes()
    {
        $view = $this->blade('<x-slate::label>Email</x-slate::label>');

        $view->assertSee('peer-disabled:cursor-not-allowed');
        $view->assertSee('peer-disabled:opacity-70');
    }

    #[Test]
    public function it_renders_label_with_custom_attributes()
    {
        $view = $this->blade('<x-slate::label class="custom-class" id="my-label">Email</x-slate::label>');

        $view->assertSee('Email');
        $view->assertSee('custom-class', false);
        $view->assertSee('id="my-label"', false);
    }

    #[Test]
    public function it_renders_label_with_required_and_error()
    {
        $view = $this->blade('<x-slate::label required error>Email</x-slate::label>');

        $view->assertSee('Email');
        $view->assertSee('text-danger');
        $view->assertSee('after:content-["*"]');
    }

    #[Test]
    public function it_renders_label_with_all_props()
    {
        $view = $this->blade('<x-slate::label for="email-input" required error size="lg">Email Address</x-slate::label>');

        $view->assertSee('Email Address');
        $view->assertSee('for="email-input"', false);
        $view->assertSee('text-base');
        $view->assertSee('text-danger');
        $view->assertSee('after:content-["*"]');
    }
}

