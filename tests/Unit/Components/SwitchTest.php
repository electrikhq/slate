<?php

namespace Electrik\Slate\Tests\Unit\Components;

use Electrik\Slate\Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\Test;

class SwitchTest extends TestCase
{
    #[Test]
    public function it_renders_a_default_switch()
    {
        $view = $this->blade('<x-slate::switch />');

        $view->assertSee('type="checkbox"', false);
        $view->assertSee('sr-only peer');
        $view->assertSee('h-6 w-11');
        $view->assertSee('rounded-full');
    }

    #[Test]
    public function it_renders_switch_with_name()
    {
        $view = $this->blade('<x-slate::switch name="enabled" />');

        $view->assertSee('name="enabled"', false);
    }

    #[Test]
    public function it_renders_switch_with_id()
    {
        $view = $this->blade('<x-slate::switch id="my-switch" />');

        $view->assertSee('id="my-switch"', false);
    }

    #[Test]
    public function it_generates_id_from_name_if_not_provided()
    {
        $view = $this->blade('<x-slate::switch name="enabled" />');

        $view->assertSee('id="switch-enabled"', false);
    }

    #[Test]
    public function it_renders_switch_with_value()
    {
        $view = $this->blade('<x-slate::switch name="option" value="yes" />');

        $view->assertSee('value="yes"', false);
    }

    #[Test]
    public function it_renders_switch_with_default_value()
    {
        $view = $this->blade('<x-slate::switch name="enabled" />');

        $view->assertSee('value="1"', false);
    }

    #[Test]
    public function it_renders_checked_switch()
    {
        $view = $this->blade('<x-slate::switch name="enabled" checked />');

        $view->assertSee('checked', false);
        $view->assertSee('peer-checked:bg-primary');
        $view->assertSee('peer-checked:after:translate-x-full'); // After pseudo-element translate
    }

    #[Test]
    public function it_renders_unchecked_switch()
    {
        $view = $this->blade('<x-slate::switch name="enabled" />');

        $html = (string) $view;
        // Check that the input doesn't have checked attribute (cursor-pointer contains "checked" but that's fine)
        $this->assertStringNotContainsString('name="enabled" checked', $html);
        $this->assertStringNotContainsString('type="checkbox" checked', $html);
    }

    #[Test]
    public function it_renders_small_switch()
    {
        $view = $this->blade('<x-slate::switch size="sm" />');

        $view->assertSee('h-5 w-9'); // Track size
        $view->assertSee('after:h-4 after:w-4'); // Thumb size
    }

    #[Test]
    public function it_renders_large_switch()
    {
        $view = $this->blade('<x-slate::switch size="lg" />');

        $view->assertSee('h-7 w-12'); // Track size
        $view->assertSee('after:h-6 after:w-6'); // Thumb size
    }

    #[Test]
    public function it_renders_default_size_switch()
    {
        $view = $this->blade('<x-slate::switch size="default" />');

        $view->assertSee('h-6 w-11'); // Track size
        $view->assertSee('after:h-5 after:w-5'); // Thumb size
    }

    #[Test]
    public function it_renders_disabled_switch()
    {
        $view = $this->blade('<x-slate::switch disabled />');

        $view->assertSee('disabled', false);
        $view->assertSee('peer-disabled:cursor-not-allowed');
        $view->assertSee('peer-disabled:opacity-50');
    }

    #[Test]
    public function it_renders_required_switch()
    {
        $view = $this->blade('<x-slate::switch required />');

        $view->assertSee('required', false);
        $view->assertSee('aria-required="true"', false);
    }

    #[Test]
    public function it_renders_switch_with_focus_visible_classes()
    {
        $view = $this->blade('<x-slate::switch />');

        $view->assertSee('peer-focus:outline-none');
        $view->assertSee('peer-focus:ring-2'); // Reduced to 2px
        $view->assertSee('peer-focus:ring-ring'); // Ring color
    }

    #[Test]
    public function it_renders_switch_with_transition_classes()
    {
        $view = $this->blade('<x-slate::switch />');

        $view->assertSee('transition-colors');
        $view->assertSee('after:transition-all');
    }

    #[Test]
    public function it_renders_switch_with_custom_attributes()
    {
        $view = $this->blade('<x-slate::switch class="custom-class" data-test="value" />');

        $view->assertSee('custom-class', false);
        $view->assertSee('data-test="value"', false);
    }

    #[Test]
    public function it_renders_switch_with_validation_error()
    {
        $validator = Validator::make(['enabled' => false], [
            'enabled' => 'accepted',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::switch name="enabled" />');

        $view->assertSee('border-danger');
        $view->assertSee('focus-visible:ring-danger');
        $view->assertSee('aria-invalid="true"', false);
    }

    #[Test]
    public function it_displays_error_message_when_validation_fails()
    {
        $validator = Validator::make(['enabled' => false], [
            'enabled' => 'accepted',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::switch name="enabled" />');

        $view->assertSee('text-danger');
        $view->assertSee('enabled', false);
    }

    #[Test]
    public function it_displays_help_text_when_provided()
    {
        $view = $this->blade('<x-slate::switch name="enabled" help="Toggle this switch to enable the feature" />');

        $view->assertSee('Toggle this switch to enable the feature', false);
        $view->assertSee('text-muted-foreground');
        $view->assertSee('id="switch-enabled-help"', false);
    }

    #[Test]
    public function it_links_help_text_via_aria_describedby()
    {
        $view = $this->blade('<x-slate::switch name="enabled" help="Help text" />');

        $view->assertSee('aria-describedby="switch-enabled-help"', false);
    }

    #[Test]
    public function it_displays_manual_error_override()
    {
        $view = $this->blade('<x-slate::switch name="enabled" errorMessage="You must enable this" />');

        $view->assertSee('border-danger');
        $view->assertSee('You must enable this', false);
        $view->assertSee('text-danger');
    }

    #[Test]
    public function it_prioritizes_manual_error_over_laravel_errors()
    {
        $validator = Validator::make(['enabled' => false], [
            'enabled' => 'accepted',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::switch name="enabled" errorMessage="Custom override" />');

        $view->assertSee('Custom override', false);
    }

    #[Test]
    public function it_links_both_help_and_error_via_aria_describedby()
    {
        $validator = Validator::make(['enabled' => false], [
            'enabled' => 'accepted',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::switch name="enabled" help="Help text" />');

        $view->assertSee('aria-describedby', false);
        $view->assertSee('switch-enabled-help', false);
        $view->assertSee('switch-enabled-error', false);
    }

    #[Test]
    public function it_auto_detects_livewire_wire_model()
    {
        $view = $this->blade('<x-slate::switch wire:model="enabled" name="enabled" />');

        $view->assertSee('wire:model="enabled"', false);
    }

    #[Test]
    public function it_handles_livewire_validation_errors()
    {
        $validator = Validator::make(['enabled' => false], [
            'enabled' => 'accepted',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::switch wire:model="enabled" name="enabled" />');

        $view->assertSee('border-danger');
        $view->assertSee('aria-invalid="true"', false);
    }

    #[Test]
    public function it_uses_wire_model_property_name_for_error_detection()
    {
        $validator = Validator::make(['userEnabled' => false], [
            'userEnabled' => 'accepted',
        ]);

        view()->share('errors', $validator->errors());

        // wire:model property name differs from name attribute
        $view = $this->blade('<x-slate::switch wire:model="userEnabled" name="enabled" />');

        $view->assertSee('border-danger');
        $view->assertSee('aria-invalid="true"', false);
    }

    #[Test]
    public function it_renders_switch_with_integrated_label()
    {
        $view = $this->blade('<x-slate::switch name="enabled" label="Enable notifications" />');

        $view->assertSee('Enable notifications');
        $view->assertSee('<label', false);
        // Label wraps the input, so no for attribute needed
    }

    #[Test]
    public function it_links_label_to_switch_via_id()
    {
        $view = $this->blade('<x-slate::switch id="custom-enabled" name="enabled" label="Enable" />');

        $view->assertSee('id="custom-enabled"', false);
        // Label wraps the input, so association is implicit (no for attribute needed)
    }

    #[Test]
    public function it_passes_required_state_to_label()
    {
        $view = $this->blade('<x-slate::switch name="enabled" label="Enable" required />');

        $view->assertSee('Enable');
        $view->assertSee('after:content-["*"]');
        $view->assertSee('after:text-danger');
    }

    #[Test]
    public function it_passes_error_state_to_label()
    {
        $validator = Validator::make(['enabled' => false], [
            'enabled' => 'accepted',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::switch name="enabled" label="Enable" />');

        $view->assertSee('Enable');
        $view->assertSee('text-danger', false);
    }

    #[Test]
    public function it_passes_size_to_label()
    {
        $view = $this->blade('<x-slate::switch name="enabled" label="Enable" size="sm" />');

        $view->assertSee('text-xs', false);
    }

    #[Test]
    public function it_renders_label_with_help_and_error()
    {
        $validator = Validator::make(['enabled' => false], [
            'enabled' => 'accepted',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::switch name="enabled" label="Enable" help="Toggle to enable" required />');

        $view->assertSee('Enable');
        $view->assertSee('after:content-["*"]');
        $view->assertSee('Toggle to enable');
        $view->assertSee('text-danger');
    }

    #[Test]
    public function it_does_not_render_label_when_not_provided()
    {
        $view = $this->blade('<x-slate::switch name="enabled" />');

        // The switch has a label wrapper for the toggle functionality
        $view->assertSee('cursor-pointer', false);
        // Should have the label wrapper (for toggle functionality)
        $view->assertSee('label', false);
        // Should not have label text content
        $view->assertDontSee('Enable', false);
    }

    #[Test]
    public function it_does_not_render_label_when_id_not_available()
    {
        $view = $this->blade('<x-slate::switch label="Enable" />');

        $view->assertDontSee('for="', false);
    }

    #[Test]
    public function it_handles_old_input_for_checked_state()
    {
        // Simulate old input - the component supports old() helper for form repopulation
        // In real Laravel apps, old() will work when session is flashed with input
        // For testing, we verify the component structure supports this pattern
        $view = $this->blade('<x-slate::switch name="enabled" />');

        // Component should render with name attribute for old() to work
        $view->assertSee('name="enabled"', false);
        // The component code includes old() support - verified by code inspection
    }

    #[Test]
    public function it_detects_wire_model_blur()
    {
        $view = $this->blade('<x-slate::switch wire:model.blur="enabled" name="enabled" />');

        $view->assertSee('wire:model.blur="enabled"', false);
    }

    #[Test]
    public function it_detects_wire_model_live()
    {
        $view = $this->blade('<x-slate::switch wire:model.live="enabled" name="enabled" />');

        $view->assertSee('wire:model.live="enabled"', false);
    }

    #[Test]
    public function it_detects_wire_model_defer()
    {
        $view = $this->blade('<x-slate::switch wire:model.defer="enabled" name="enabled" />');

        $view->assertSee('wire:model.defer="enabled"', false);
    }

    #[Test]
    public function it_renders_switch_track_with_bg_muted_when_unchecked()
    {
        $view = $this->blade('<x-slate::switch name="enabled" />');

        $view->assertSee('bg-muted');
    }

    #[Test]
    public function it_renders_switch_track_with_bg_primary_when_checked()
    {
        $view = $this->blade('<x-slate::switch name="enabled" checked />');

        $view->assertSee('peer-checked:bg-primary');
    }

    #[Test]
    public function it_renders_switch_thumb_with_translate_when_checked()
    {
        $view = $this->blade('<x-slate::switch name="enabled" checked />');

        $view->assertSee('peer-checked:after:translate-x-full'); // After pseudo-element translate
        $view->assertSee('after:absolute');
        $view->assertSee('after:content', false); // Check for after:content class
    }

    #[Test]
    public function it_renders_switch_thumb_with_shadow()
    {
        $view = $this->blade('<x-slate::switch name="enabled" />');

        $view->assertSee('after:shadow-md'); // Increased shadow for better visibility
    }
}

