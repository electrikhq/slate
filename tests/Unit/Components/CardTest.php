<?php

namespace Electrik\Slate\Tests\Unit\Components;

use Electrik\Slate\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CardTest extends TestCase
{
    #[Test]
    public function it_renders_a_card()
    {
        $view = $this->blade('<x-slate::card>Card content</x-slate::card>');

        $view->assertSee('Card content');
        $view->assertSee('rounded-lg');
        $view->assertSee('border');
        $view->assertSee('bg-card');
        $view->assertSee('text-card-foreground');
        $view->assertSee('shadow-sm');
    }

    #[Test]
    public function it_renders_card_with_custom_classes()
    {
        $view = $this->blade('<x-slate::card class="custom-class">Content</x-slate::card>');

        $view->assertSee('Content');
        $view->assertSee('custom-class', false);
    }

    #[Test]
    public function it_renders_card_with_header()
    {
        $view = $this->blade('
            <x-slate::card>
                <x-slate::card-header>Header content</x-slate::card-header>
            </x-slate::card>
        ');

        $view->assertSee('Header content');
        $view->assertSee('flex flex-col space-y-1.5 p-6');
    }

    #[Test]
    public function it_renders_card_with_title()
    {
        $view = $this->blade('
            <x-slate::card>
                <x-slate::card-title>Card Title</x-slate::card-title>
            </x-slate::card>
        ');

        $view->assertSee('Card Title');
        $view->assertSee('text-2xl');
        $view->assertSee('font-semibold');
        $view->assertSee('leading-none');
        $view->assertSee('tracking-tight');
    }

    #[Test]
    public function it_renders_card_title_with_custom_tag()
    {
        $view = $this->blade('
            <x-slate::card>
                <x-slate::card-title as="h1">Card Title</x-slate::card-title>
            </x-slate::card>
        ');

        $view->assertSee('Card Title');
        $view->assertSee('<h1', false);
        $view->assertDontSee('<h3', false);
    }

    #[Test]
    public function it_renders_card_with_description()
    {
        $view = $this->blade('
            <x-slate::card>
                <x-slate::card-description>Card description</x-slate::card-description>
            </x-slate::card>
        ');

        $view->assertSee('Card description');
        $view->assertSee('text-sm');
        $view->assertSee('text-muted-foreground');
    }

    #[Test]
    public function it_renders_card_with_content()
    {
        $view = $this->blade('
            <x-slate::card>
                <x-slate::card-content>Card content</x-slate::card-content>
            </x-slate::card>
        ');

        $view->assertSee('Card content');
        $view->assertSee('p-6');
    }

    #[Test]
    public function it_renders_card_with_footer()
    {
        $view = $this->blade('
            <x-slate::card>
                <x-slate::card-footer>Footer content</x-slate::card-footer>
            </x-slate::card>
        ');

        $view->assertSee('Footer content');
        $view->assertSee('flex items-center p-6 pt-0');
    }

    #[Test]
    public function it_renders_complete_card_structure()
    {
        $view = $this->blade('
            <x-slate::card>
                <x-slate::card-header>
                    <x-slate::card-title>Card Title</x-slate::card-title>
                    <x-slate::card-description>Card description</x-slate::card-description>
                </x-slate::card-header>
                <x-slate::card-content>
                    Main content here
                </x-slate::card-content>
                <x-slate::card-footer>
                    Footer actions
                </x-slate::card-footer>
            </x-slate::card>
        ');

        $view->assertSee('Card Title');
        $view->assertSee('Card description');
        $view->assertSee('Main content here');
        $view->assertSee('Footer actions');
    }

    #[Test]
    public function it_renders_card_with_only_content()
    {
        $view = $this->blade('
            <x-slate::card>
                <x-slate::card-content>Simple card content</x-slate::card-content>
            </x-slate::card>
        ');

        $view->assertSee('Simple card content');
    }

    #[Test]
    public function it_renders_card_with_custom_attributes()
    {
        $view = $this->blade('<x-slate::card id="my-card" data-test="card">Content</x-slate::card>');

        $view->assertSee('Content');
        $view->assertSee('id="my-card"', false);
        $view->assertSee('data-test="card"', false);
    }
}

