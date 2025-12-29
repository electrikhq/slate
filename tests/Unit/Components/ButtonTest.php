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

    #[Test]
    public function it_renders_button_with_manual_loading_state()
    {
        $view = $this->blade('<x-slate::button loading>Submit</x-slate::button>');

        $view->assertSee('disabled', false);
        $view->assertSee('animate-spin');
    }

    #[Test]
    public function it_shows_loading_text_when_provided()
    {
        $view = $this->blade('<x-slate::button loading loadingText="Saving...">Submit</x-slate::button>');

        $view->assertSee('Saving...');
        $view->assertDontSee('Submit');
        $view->assertSee('animate-spin');
    }

    #[Test]
    public function it_shows_original_text_when_loading_without_loading_text()
    {
        $view = $this->blade('<x-slate::button loading>Submit</x-slate::button>');

        $view->assertSee('Submit');
        $view->assertSee('animate-spin');
    }

    #[Test]
    public function it_hides_spinner_when_show_spinner_is_false()
    {
        $view = $this->blade('<x-slate::button loading showSpinner="false">Submit</x-slate::button>');

        $view->assertSee('Submit');
        $view->assertDontSee('animate-spin');
    }

    #[Test]
    public function it_auto_detects_livewire_wire_click()
    {
        $view = $this->blade('<x-slate::button wire:click="submit">Submit</x-slate::button>');

        $view->assertSee('wire:click="submit"', false);
        $view->assertSee('wire:loading.attr="disabled"', false);
        $view->assertSee('wire:loading', false);
    }

    #[Test]
    public function it_auto_detects_livewire_wire_submit()
    {
        $view = $this->blade('<x-slate::button wire:submit="save">Save</x-slate::button>');

        $view->assertSee('wire:submit="save"', false);
        $view->assertSee('wire:loading.attr="disabled"', false);
        $view->assertSee('wire:loading', false);
    }

    #[Test]
    public function it_shows_loading_text_with_livewire()
    {
        $view = $this->blade('<x-slate::button wire:click="submit" loadingText="Saving...">Submit</x-slate::button>');

        $view->assertSee('wire:loading', false);
        // Should show loading text when loading
        $view->assertSee('Saving...');
    }

    #[Test]
    public function it_uses_wire_target_when_provided()
    {
        $view = $this->blade('<x-slate::button wire:click="submit" wire:target="save">Submit</x-slate::button>');

        $view->assertSee('wire:target="save"', false);
    }

    #[Test]
    public function it_sets_aria_busy_when_loading_manually()
    {
        $view = $this->blade('<x-slate::button loading>Submit</x-slate::button>');

        $view->assertSee('aria-busy="true"', false);
    }

    #[Test]
    public function it_sets_aria_busy_when_livewire_detected()
    {
        $view = $this->blade('<x-slate::button wire:click="submit">Submit</x-slate::button>');

        $view->assertSee('aria-busy="true"', false);
    }

    #[Test]
    public function it_sets_aria_disabled_when_disabled()
    {
        $view = $this->blade('<x-slate::button disabled>Disabled</x-slate::button>');

        $view->assertSee('aria-disabled="true"', false);
    }

    #[Test]
    public function it_sets_aria_disabled_when_loading()
    {
        $view = $this->blade('<x-slate::button loading>Submit</x-slate::button>');

        $view->assertSee('aria-disabled="true"', false);
    }

    #[Test]
    public function it_sets_both_aria_attributes_when_loading()
    {
        $view = $this->blade('<x-slate::button loading>Submit</x-slate::button>');

        $view->assertSee('aria-busy="true"', false);
        $view->assertSee('aria-disabled="true"', false);
    }

    #[Test]
    public function it_does_not_set_aria_busy_when_not_loading()
    {
        $view = $this->blade('<x-slate::button>Normal</x-slate::button>');

        $view->assertDontSee('aria-busy', false);
    }

    #[Test]
    public function it_does_not_set_aria_disabled_when_not_disabled_or_loading()
    {
        $view = $this->blade('<x-slate::button>Normal</x-slate::button>');

        $view->assertDontSee('aria-disabled', false);
    }

    #[Test]
    public function it_renders_button_with_icon_on_left()
    {
        // Skip if Blade Icons not available
        if (!function_exists('svg')) {
            $this->markTestSkipped('Blade Icons not available in test environment');
        }

        $view = $this->blade('<x-slate::button icon="carbon-envelope">Send Email</x-slate::button>');

        $view->assertSee('Send Email');
        $view->assertSee('mr-2');
    }

    #[Test]
    public function it_renders_button_with_icon_on_right()
    {
        // Skip if Blade Icons not available
        if (!function_exists('svg')) {
            $this->markTestSkipped('Blade Icons not available in test environment');
        }

        $view = $this->blade('<x-slate::button icon="carbon-download" icon-position="right">Download</x-slate::button>');

        $view->assertSee('Download');
        $view->assertSee('ml-2');
    }

    #[Test]
    public function it_renders_icon_only_button_when_slot_is_empty()
    {
        // Skip if Blade Icons not available
        if (!function_exists('svg')) {
            $this->markTestSkipped('Blade Icons not available in test environment');
        }

        $view = $this->blade('<x-slate::button icon="carbon-settings"></x-slate::button>');

        $view->assertSee('h-10 w-10');
        $view->assertSee('p-0');
        // Should not have spacing classes for icon-only
        $view->assertDontSee('mr-2');
        $view->assertDontSee('ml-2');
    }

    #[Test]
    public function it_applies_correct_icon_size_for_small_button()
    {
        // Skip if Blade Icons not available
        if (!function_exists('svg')) {
            $this->markTestSkipped('Blade Icons not available in test environment');
        }

        $view = $this->blade('<x-slate::button icon="carbon-envelope" size="sm">Small</x-slate::button>');

        $view->assertSee('h-3 w-3');
    }

    #[Test]
    public function it_applies_correct_icon_size_for_default_button()
    {
        // Skip if Blade Icons not available
        if (!function_exists('svg')) {
            $this->markTestSkipped('Blade Icons not available in test environment');
        }

        $view = $this->blade('<x-slate::button icon="carbon-envelope">Default</x-slate::button>');

        $view->assertSee('h-4 w-4');
    }

    #[Test]
    public function it_applies_correct_icon_size_for_large_button()
    {
        // Skip if Blade Icons not available
        if (!function_exists('svg')) {
            $this->markTestSkipped('Blade Icons not available in test environment');
        }

        $view = $this->blade('<x-slate::button icon="carbon-envelope" size="lg">Large</x-slate::button>');

        $view->assertSee('h-5 w-5');
    }

    #[Test]
    public function it_renders_icon_only_button_with_correct_dimensions_for_small()
    {
        // Skip if Blade Icons not available
        if (!function_exists('svg')) {
            $this->markTestSkipped('Blade Icons not available in test environment');
        }

        $view = $this->blade('<x-slate::button icon="carbon-settings" size="sm"></x-slate::button>');

        $view->assertSee('h-9 w-9');
    }

    #[Test]
    public function it_renders_icon_only_button_with_correct_dimensions_for_large()
    {
        // Skip if Blade Icons not available
        if (!function_exists('svg')) {
            $this->markTestSkipped('Blade Icons not available in test environment');
        }

        $view = $this->blade('<x-slate::button icon="carbon-settings" size="lg"></x-slate::button>');

        $view->assertSee('h-11 w-11');
    }

    #[Test]
    public function it_automatically_adds_aria_label_for_icon_only_button()
    {
        // Icon rendering may fail in test environment, but aria-label should still be added
        $view = $this->blade('<x-slate::button icon="carbon-settings"></x-slate::button>');
        $view->assertSee('aria-label="Settings"', false);
    }

    #[Test]
    public function it_generates_readable_aria_label_from_icon_name()
    {
        $view = $this->blade('<x-slate::button icon="carbon-trash-can"></x-slate::button>');
        $view->assertSee('aria-label="Trash Can"', false);
    }

    #[Test]
    public function it_uses_manual_aria_label_over_automatic_one()
    {
        $view = $this->blade('<x-slate::button icon="carbon-settings" aria-label="Custom Label"></x-slate::button>');
        $view->assertSee('aria-label="Custom Label"', false);
        // Should not have automatic aria-label
        $view->assertDontSee('aria-label="Settings"', false);
    }

    #[Test]
    public function it_does_not_add_aria_label_when_button_has_text()
    {
        $view = $this->blade('<x-slate::button icon="carbon-settings">Settings</x-slate::button>');
        // Should not have auto-generated aria-label since button has visible text
        $view->assertDontSee('aria-label="Settings"', false);
    }

    #[Test]
    public function it_handles_icon_names_without_carbon_prefix()
    {
        $view = $this->blade('<x-slate::button icon="settings"></x-slate::button>');
        // Should still generate aria-label
        $view->assertSee('aria-label="Settings"', false);
    }

    #[Test]
    public function it_handles_icon_names_with_underscores()
    {
        $view = $this->blade('<x-slate::button icon="carbon-user_profile"></x-slate::button>');
        $view->assertSee('aria-label="User Profile"', false);
    }
}

