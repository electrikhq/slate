<?php

namespace Electrik\Slate\Tests\Unit\Components;

use Electrik\Slate\Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\Test;

class InputTest extends TestCase
{
    #[Test]
    public function it_renders_a_default_input()
    {
        $view = $this->blade('<x-slate::input />');

        $view->assertSee('type="text"', false);
        $view->assertSee('border-input');
        $view->assertSee('bg-background');
        $view->assertSee('h-10');
        $view->assertSee('px-3');
    }

    #[Test]
    public function it_renders_input_with_custom_type()
    {
        $view = $this->blade('<x-slate::input type="email" />');

        $view->assertSee('type="email"', false);
    }

    #[Test]
    public function it_renders_input_with_name()
    {
        $view = $this->blade('<x-slate::input name="email" />');

        $view->assertSee('name="email"', false);
    }

    #[Test]
    public function it_renders_input_with_id()
    {
        $view = $this->blade('<x-slate::input id="my-input" />');

        $view->assertSee('id="my-input"', false);
    }

    #[Test]
    public function it_generates_id_from_name_if_not_provided()
    {
        $view = $this->blade('<x-slate::input name="email" />');

        $view->assertSee('id="input-email"', false);
    }

    #[Test]
    public function it_renders_input_with_placeholder()
    {
        $view = $this->blade('<x-slate::input placeholder="Enter your email" />');

        $view->assertSee('placeholder="Enter your email"', false);
    }

    #[Test]
    public function it_renders_input_with_value()
    {
        $view = $this->blade('<x-slate::input value="test@example.com" />');

        $view->assertSee('value="test@example.com"', false);
    }

    #[Test]
    public function it_renders_small_input()
    {
        $view = $this->blade('<x-slate::input size="sm" />');

        $view->assertSee('h-9');
        $view->assertSee('px-2.5');
        $view->assertSee('text-sm');
    }

    #[Test]
    public function it_renders_large_input()
    {
        $view = $this->blade('<x-slate::input size="lg" />');

        $view->assertSee('h-11');
        $view->assertSee('px-4');
        $view->assertSee('text-sm');
    }

    #[Test]
    public function it_renders_default_size_input()
    {
        $view = $this->blade('<x-slate::input size="default" />');

        $view->assertSee('h-10');
        $view->assertSee('px-3');
    }

    #[Test]
    public function it_renders_disabled_input()
    {
        $view = $this->blade('<x-slate::input disabled />');

        $view->assertSee('disabled', false);
        $view->assertSee('disabled:cursor-not-allowed');
        $view->assertSee('disabled:opacity-50');
    }

    #[Test]
    public function it_renders_readonly_input()
    {
        $view = $this->blade('<x-slate::input readonly />');

        $view->assertSee('readonly', false);
    }

    #[Test]
    public function it_renders_required_input()
    {
        $view = $this->blade('<x-slate::input required />');

        $view->assertSee('required', false);
        $view->assertSee('aria-required="true"', false);
    }

    #[Test]
    public function it_renders_autofocus_input()
    {
        $view = $this->blade('<x-slate::input autofocus />');

        $view->assertSee('autofocus', false);
    }

    #[Test]
    public function it_renders_input_with_focus_visible_classes()
    {
        $view = $this->blade('<x-slate::input />');

        $view->assertSee('focus-visible:outline-none');
        $view->assertSee('focus-visible:ring-2');
        $view->assertSee('focus-visible:ring-ring');
        $view->assertSee('focus-visible:ring-offset-2');
    }

    #[Test]
    public function it_renders_input_with_placeholder_styling()
    {
        $view = $this->blade('<x-slate::input placeholder="Enter text" />');

        $view->assertSee('placeholder:text-muted-foreground');
    }

    #[Test]
    public function it_renders_input_with_file_input_styling()
    {
        $view = $this->blade('<x-slate::input type="file" />');

        $view->assertSee('file:border-0');
        $view->assertSee('file:bg-transparent');
        $view->assertSee('file:text-sm');
        $view->assertSee('file:font-medium');
    }

    #[Test]
    public function it_renders_input_with_transition_colors()
    {
        $view = $this->blade('<x-slate::input />');

        $view->assertSee('transition-colors');
    }

    #[Test]
    public function it_renders_input_with_custom_attributes()
    {
        $view = $this->blade('<x-slate::input class="custom-class" data-test="value" />');

        $view->assertSee('custom-class', false);
        $view->assertSee('data-test="value"', false);
    }

    #[Test]
    public function it_renders_input_with_validation_error()
    {
        $validator = Validator::make(['email' => 'invalid'], [
            'email' => 'required|email',
        ]);

        // Share errors with view
        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::input name="email" />');

        $view->assertSee('border-danger');
        $view->assertSee('focus-visible:ring-danger');
        $view->assertSee('aria-invalid="true"', false);
    }

    #[Test]
    public function it_displays_error_message_when_validation_fails()
    {
        $validator = Validator::make(['email' => 'invalid'], [
            'email' => 'required|email',
        ]);

        // Share errors with view
        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::input name="email" />');

        $view->assertSee('text-danger');
        // Error message should be present
        $view->assertSee('email', false);
    }

    #[Test]
    public function it_renders_different_input_types()
    {
        $types = ['text', 'email', 'password', 'number', 'tel', 'url', 'search', 'date', 'time', 'datetime-local'];

        foreach ($types as $type) {
            $view = $this->blade("<x-slate::input type=\"{$type}\" />");
            $view->assertSee("type=\"{$type}\"", false);
        }
    }

    #[Test]
    public function it_displays_help_text_when_provided()
    {
        $view = $this->blade('<x-slate::input name="email" help="We will never share your email" />');

        $view->assertSee('We will never share your email', false);
        $view->assertSee('text-muted-foreground');
        $view->assertSee('id="input-email-help"', false);
    }

    #[Test]
    public function it_links_help_text_via_aria_describedby()
    {
        $view = $this->blade('<x-slate::input name="email" help="Help text" />');

        $view->assertSee('aria-describedby="input-email-help"', false);
    }

    #[Test]
    public function it_displays_manual_error_override()
    {
        $view = $this->blade('<x-slate::input name="email" errorMessage="Custom error message" />');

        $view->assertSee('border-danger');
        $view->assertSee('Custom error message', false);
        $view->assertSee('text-danger');
    }

    #[Test]
    public function it_prioritizes_manual_error_over_laravel_errors()
    {
        $validator = Validator::make(['email' => 'invalid'], [
            'email' => 'required|email',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::input name="email" errorMessage="Custom override" />');

        // Should show custom error, not Laravel error
        $view->assertSee('Custom override', false);
        $view->assertDontSee('The email field is required', false);
    }

    #[Test]
    public function it_links_both_help_and_error_via_aria_describedby()
    {
        $validator = Validator::make(['email' => 'invalid'], [
            'email' => 'required|email',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::input name="email" help="Help text" />');

        // Should have both IDs in aria-describedby
        $view->assertSee('aria-describedby', false);
        $view->assertSee('input-email-help', false);
        $view->assertSee('input-email-error', false);
    }

    #[Test]
    public function it_auto_detects_livewire_wire_model()
    {
        $view = $this->blade('<x-slate::input wire:model="email" name="email" />');

        // Should render wire:model attribute
        $view->assertSee('wire:model="email"', false);
    }

    #[Test]
    public function it_handles_livewire_validation_errors()
    {
        $validator = Validator::make(['email' => 'invalid'], [
            'email' => 'required|email',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::input wire:model="email" name="email" />');

        $view->assertSee('border-danger');
        $view->assertSee('aria-invalid="true"', false);
    }

    #[Test]
    public function it_uses_wire_model_property_name_for_error_detection()
    {
        $validator = Validator::make(['userEmail' => 'invalid'], [
            'userEmail' => 'required|email',
        ]);

        view()->share('errors', $validator->errors());

        // wire:model property name differs from name attribute
        $view = $this->blade('<x-slate::input wire:model="userEmail" name="email" />');

        $view->assertSee('border-danger');
        $view->assertSee('aria-invalid="true"', false);
    }

    #[Test]
    public function it_does_not_set_value_when_using_wire_model()
    {
        $view = $this->blade('<x-slate::input wire:model="email" value="static-value" />');

        // When using wire:model, value should not be set (Livewire handles it)
        $html = (string) $view;
        $this->assertStringNotContainsString('value="static-value"', $html);
        $this->assertStringContainsString('wire:model="email"', $html);
    }

    #[Test]
    public function it_sets_value_when_not_using_wire_model()
    {
        $view = $this->blade('<x-slate::input name="email" value="static-value" />');

        $view->assertSee('value="static-value"', false);
    }

    #[Test]
    public function it_detects_wire_model_blur()
    {
        $view = $this->blade('<x-slate::input wire:model.blur="email" name="email" />');

        $view->assertSee('wire:model.blur="email"', false);
    }

    #[Test]
    public function it_detects_wire_model_live()
    {
        $view = $this->blade('<x-slate::input wire:model.live="email" name="email" />');

        $view->assertSee('wire:model.live="email"', false);
    }

    #[Test]
    public function it_detects_wire_model_defer()
    {
        $view = $this->blade('<x-slate::input wire:model.defer="email" name="email" />');

        $view->assertSee('wire:model.defer="email"', false);
    }

    #[Test]
    public function it_renders_input_with_integrated_label()
    {
        $view = $this->blade('<x-slate::input name="email" label="Email Address" />');

        $view->assertSee('Email Address');
        $view->assertSee('for="input-email"', false);
        $view->assertSee('<label', false);
    }

    #[Test]
    public function it_links_label_to_input_via_id()
    {
        $view = $this->blade('<x-slate::input id="custom-email" name="email" label="Email" />');

        $view->assertSee('for="custom-email"', false);
        $view->assertSee('id="custom-email"', false);
    }

    #[Test]
    public function it_passes_required_state_to_label()
    {
        $view = $this->blade('<x-slate::input name="email" label="Email" required />');

        $view->assertSee('Email');
        $view->assertSee('after:content-["*"]');
        $view->assertSee('after:text-danger');
    }

    #[Test]
    public function it_passes_error_state_to_label()
    {
        $validator = Validator::make(['email' => 'invalid'], [
            'email' => 'required|email',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::input name="email" label="Email" />');

        $view->assertSee('Email');
        $view->assertSee('text-danger', false);
    }

    #[Test]
    public function it_passes_size_to_label()
    {
        $view = $this->blade('<x-slate::input name="email" label="Email" size="sm" />');

        $view->assertSee('text-xs', false);
    }

    #[Test]
    public function it_renders_label_with_help_and_error()
    {
        $validator = Validator::make(['email' => 'invalid'], [
            'email' => 'required|email',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::input name="email" label="Email" help="Enter your email" required />');

        $view->assertSee('Email');
        $view->assertSee('after:content-["*"]');
        $view->assertSee('Enter your email');
        $view->assertSee('text-danger');
    }

    #[Test]
    public function it_does_not_render_label_when_not_provided()
    {
        $view = $this->blade('<x-slate::input name="email" />');

        $view->assertDontSee('<label', false);
    }

    #[Test]
    public function it_does_not_render_label_when_id_not_available()
    {
        $view = $this->blade('<x-slate::input label="Email" />');

        // Label should not render if no id/name to generate id from
        $view->assertDontSee('for="', false);
    }
}

