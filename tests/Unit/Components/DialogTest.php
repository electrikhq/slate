<?php

namespace Electrik\Slate\Tests\Unit\Components;

use Electrik\Slate\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class DialogTest extends TestCase
{
    #[Test]
    public function it_renders_dialog_component()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" :open="false">
                <x-slate::dialog-content>
                    Dialog content
                </x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('Dialog content');
        $view->assertSee('test-dialog', false);
        $view->assertSee('role="dialog"', false);
        $view->assertSee('aria-modal="true"', false);
    }

    public function test_it_renders_dialog_with_custom_id()
    {
        $view = $this->blade(
            '<x-slate::dialog id="custom-dialog-id" :open="false">
                <x-slate::dialog-content>Content</x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('data-dialog-id="custom-dialog-id"', false);
    }

    public function test_it_generates_unique_id_when_not_provided()
    {
        $view = $this->blade(
            '<x-slate::dialog :open="false">
                <x-slate::dialog-content>Content</x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('data-dialog-id="dialog-', false);
    }

    public function test_it_renders_dialog_with_backdrop()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" :open="false">
                <x-slate::dialog-content>Content</x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('bg-black/50', false);
        $view->assertSee('backdrop-blur-sm', false);
    }

    public function test_it_renders_dialog_content()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" :open="false">
                <x-slate::dialog-content>
                    <p>Test content</p>
                </x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('Test content');
        $view->assertSee('max-w-lg', false);
        $view->assertSee('rounded-lg', false);
        $view->assertSee('bg-background', false);
    }

    public function test_it_renders_dialog_header()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" :open="false">
                <x-slate::dialog-content>
                    <x-slate::dialog-header>
                        Header content
                    </x-slate::dialog-header>
                </x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('Header content');
        $view->assertSee('flex flex-col space-y-1.5', false);
    }

    public function test_it_renders_dialog_footer()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" :open="false">
                <x-slate::dialog-content>
                    <x-slate::dialog-footer>
                        Footer content
                    </x-slate::dialog-footer>
                </x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('Footer content');
        $view->assertSee('flex flex-col-reverse sm:flex-row', false);
    }

    public function test_it_renders_dialog_title()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" :open="false">
                <x-slate::dialog-content>
                    <x-slate::dialog-header>
                        <x-slate::dialog-title>Test Title</x-slate::dialog-title>
                    </x-slate::dialog-header>
                </x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('Test Title');
        $view->assertSee('<h2', false);
        $view->assertSee('text-lg font-semibold', false);
    }

    public function test_it_renders_dialog_title_with_custom_tag()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" :open="false">
                <x-slate::dialog-content>
                    <x-slate::dialog-header>
                        <x-slate::dialog-title as="h1">Test Title</x-slate::dialog-title>
                    </x-slate::dialog-header>
                </x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('<h1', false);
        $view->assertSee('Test Title');
    }

    public function test_it_renders_dialog_description()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" :open="false">
                <x-slate::dialog-content>
                    <x-slate::dialog-header>
                        <x-slate::dialog-description>Test Description</x-slate::dialog-description>
                    </x-slate::dialog-header>
                </x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('Test Description');
        $view->assertSee('<p', false);
        $view->assertSee('text-sm text-muted-foreground', false);
    }

    public function test_it_renders_dialog_description_with_custom_tag()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" :open="false">
                <x-slate::dialog-content>
                    <x-slate::dialog-header>
                        <x-slate::dialog-description as="div">Test Description</x-slate::dialog-description>
                    </x-slate::dialog-header>
                </x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('<div', false);
        $view->assertSee('Test Description');
    }

    public function test_it_renders_dialog_close_button()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" :open="false">
                <x-slate::dialog-close />
                <x-slate::dialog-content>Content</x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('aria-label="Close"', false);
        $view->assertSee('absolute right-4 top-4', false);
        $view->assertSee('sr-only', false);
    }

    public function test_it_renders_dialog_trigger()
    {
        $view = $this->blade(
            '<x-slate::dialog-trigger target="test-dialog">
                Open Dialog
            </x-slate::dialog-trigger>'
        );

        $view->assertSee('Open Dialog');
        $view->assertSee('<button', false);
        $view->assertSee('type="button"', false);
    }

    public function test_it_renders_dialog_trigger_with_custom_tag()
    {
        $view = $this->blade(
            '<x-slate::dialog-trigger target="test-dialog" as="a">
                Open Dialog
            </x-slate::dialog-trigger>'
        );

        $view->assertSee('<a', false);
        $view->assertSee('Open Dialog');
    }

    public function test_dialog_has_aria_attributes()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" :open="false">
                <x-slate::dialog-content>
                    <x-slate::dialog-header>
                        <x-slate::dialog-title>Title</x-slate::dialog-title>
                        <x-slate::dialog-description>Description</x-slate::dialog-description>
                    </x-slate::dialog-header>
                </x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('aria-labelledby="test-dialog-title"', false);
        $view->assertSee('aria-describedby="test-dialog-description"', false);
    }

    public function test_dialog_has_alpine_data()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" :open="false">
                <x-slate::dialog-content>Content</x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('x-data', false);
        $view->assertSee('x-show="open"', false);
        $view->assertSee('x-cloak', false);
    }

    public function test_dialog_handles_open_prop()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" :open="true">
                <x-slate::dialog-content>Content</x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('open: true', false);
    }

    public function test_dialog_handles_open_prop_as_string()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" open="1">
                <x-slate::dialog-content>Content</x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('open: true', false);
    }

    public function test_dialog_supports_livewire_wire_model()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" wire:model="showDialog" :open="false">
                <x-slate::dialog-content>Content</x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('wireProperty', false);
        $view->assertSee('showDialog', false);
    }

    public function test_dialog_supports_livewire_wire_model_live()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" wire:model.live="showDialog" :open="false">
                <x-slate::dialog-content>Content</x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('wireProperty', false);
    }

    public function test_dialog_has_transitions()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" :open="false">
                <x-slate::dialog-content>Content</x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('x-transition:enter', false);
        $view->assertSee('x-transition:leave', false);
    }

    public function test_dialog_has_escape_key_handler()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" :open="false">
                <x-slate::dialog-content>Content</x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('@keydown.escape.window', false);
    }

    public function test_dialog_close_has_custom_classes()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" :open="false">
                <x-slate::dialog-close class="custom-class" />
                <x-slate::dialog-content>Content</x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('custom-class', false);
    }

    public function test_dialog_content_has_custom_classes()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" :open="false">
                <x-slate::dialog-content class="custom-content">
                    Content
                </x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('custom-content', false);
    }

    public function test_dialog_header_has_custom_classes()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" :open="false">
                <x-slate::dialog-content>
                    <x-slate::dialog-header class="custom-header">
                        Header
                    </x-slate::dialog-header>
                </x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('custom-header', false);
    }

    public function test_dialog_footer_has_custom_classes()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" :open="false">
                <x-slate::dialog-content>
                    <x-slate::dialog-footer class="custom-footer">
                        Footer
                    </x-slate::dialog-footer>
                </x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('custom-footer', false);
    }

    public function test_dialog_title_has_custom_classes()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" :open="false">
                <x-slate::dialog-content>
                    <x-slate::dialog-header>
                        <x-slate::dialog-title class="custom-title">Title</x-slate::dialog-title>
                    </x-slate::dialog-header>
                </x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('custom-title', false);
    }

    public function test_dialog_description_has_custom_classes()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" :open="false">
                <x-slate::dialog-content>
                    <x-slate::dialog-header>
                        <x-slate::dialog-description class="custom-description">Description</x-slate::dialog-description>
                    </x-slate::dialog-header>
                </x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('custom-description', false);
    }

    public function test_dialog_trigger_has_custom_classes()
    {
        $view = $this->blade(
            '<x-slate::dialog-trigger target="test-dialog" class="custom-trigger">
                Open
            </x-slate::dialog-trigger>'
        );

        $view->assertSee('custom-trigger', false);
    }

    public function test_dialog_close_with_target()
    {
        $view = $this->blade(
            '<x-slate::dialog id="test-dialog" :open="false">
                <x-slate::dialog-close target="test-dialog" />
                <x-slate::dialog-content>Content</x-slate::dialog-content>
            </x-slate::dialog>'
        );

        $view->assertSee('close-dialog-test-dialog', false);
    }
}

