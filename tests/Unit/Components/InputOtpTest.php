<?php

namespace Electrik\Slate\Tests\Unit\Components;

use Electrik\Slate\Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\Test;

class InputOtpTest extends TestCase
{
    #[Test]
    public function it_renders_default_input_otp_with_6_fields()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" />');

        // Should render 6 input fields by default
        $view->assertSee('id="input-otp-otp-0"', false);
        $view->assertSee('id="input-otp-otp-5"', false);
        $view->assertSee('maxlength="1"', false);
        $view->assertSee('border-input');
    }

    #[Test]
    public function it_renders_custom_length()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" length="4" />');

        $view->assertSee('id="input-otp-otp-0"', false);
        $view->assertSee('id="input-otp-otp-3"', false);
        $view->assertDontSee('id="input-otp-otp-4"', false);
    }

    #[Test]
    public function it_renders_with_name()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" />');

        $view->assertSee('name="otp"', false);
        $view->assertSee('id="input-otp-otp-0"', false);
        $view->assertSee('id="input-otp-otp-value"', false);
    }

    #[Test]
    public function it_renders_with_custom_id()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" id="my-otp" />');

        $view->assertSee('id="my-otp-0"', false);
        $view->assertSee('id="my-otp-value"', false);
    }

    #[Test]
    public function it_renders_with_label()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" label="Enter OTP" />');

        $view->assertSee('Enter OTP');
        $view->assertSee('for="input-otp-otp-value"', false);
    }

    #[Test]
    public function it_renders_with_help_text()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" help="Enter the 6-digit code" />');

        $view->assertSee('Enter the 6-digit code');
        $view->assertSee('id="input-otp-otp-help"', false);
    }

    #[Test]
    public function it_renders_with_error_message()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" errorMessage="Invalid OTP" />');

        $view->assertSee('Invalid OTP');
        $view->assertSee('text-danger');
        $view->assertSee('border-danger');
        $view->assertSee('aria-invalid="true"', false);
    }

    #[Test]
    public function it_renders_disabled_state()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" disabled />');

        $view->assertSee('disabled', false);
        $view->assertSee('disabled:cursor-not-allowed');
    }

    #[Test]
    public function it_renders_readonly_state()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" readonly />');

        $view->assertSee('readonly', false);
    }

    #[Test]
    public function it_renders_required_state()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" required />');

        $view->assertSee('required', false);
        $view->assertSee('aria-required="true"', false);
    }

    #[Test]
    public function it_renders_with_autofocus()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" autofocus />');

        // Should have Alpine.js logic for autofocus
        $view->assertSee('focusedIndex: 0', false);
    }

    #[Test]
    public function it_renders_size_variants()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" size="sm" />');
        $view->assertSee('h-9 w-9');

        $view = $this->blade('<x-slate::input-otp name="otp" size="lg" />');
        $view->assertSee('h-11 w-11');
        $view->assertSee('text-base');
    }

    #[Test]
    public function it_renders_password_type()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" type="password" />');

        $view->assertSee('type="password"', false);
    }

    #[Test]
    public function it_includes_alpine_js_data()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" length="6" />');

        $view->assertSee('x-data', false);
        $view->assertSee('length: 6', false);
        $view->assertSee('handleInput', false);
        $view->assertSee('handleKeydown', false);
        $view->assertSee('handlePaste', false);
    }

    #[Test]
    public function it_includes_hidden_input_for_form_submission()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" />');

        $view->assertSee('type="hidden"', false);
        $view->assertSee('id="input-otp-otp-value"', false);
        $view->assertSee('name="otp"', false);
        $view->assertSee('x-bind:value="getValue()"', false);
    }

    #[Test]
    public function it_handles_laravel_validation_errors()
    {
        $validator = Validator::make(['otp' => ''], [
            'otp' => 'required|size:6',
        ]);
        $validator->fails();

        // Share errors with view
        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::input-otp name="otp" />');

        $view->assertSee('border-danger');
    }

    #[Test]
    public function it_handles_livewire_validation_errors()
    {
        $validator = Validator::make(['code' => ''], [
            'code' => 'required|size:6',
        ]);
        $validator->fails();

        // Share errors with view
        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::input-otp name="code" wire:model="code" />');

        $view->assertSee('border-danger');
    }

    #[Test]
    public function it_uses_wire_model_property_name_for_error_detection()
    {
        $validator = Validator::make(['verification_code' => ''], [
            'verification_code' => 'required',
        ]);
        $validator->fails();

        // Share errors with view
        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::input-otp wire:model="verification_code" />');

        $view->assertSee('border-danger');
    }

    #[Test]
    public function it_supports_wire_model_live()
    {
        $view = $this->blade('<x-slate::input-otp name="code" wire:model.live="code" />');

        // wire:model attributes are detected but not rendered on container
        $view->assertSee('wireProperty:', false);
        $view->assertSee('$wire.set', false);
    }

    #[Test]
    public function it_supports_wire_model_defer()
    {
        $view = $this->blade('<x-slate::input-otp name="code" wire:model.defer="code" />');

        // wire:model attributes are detected but not rendered on container
        $view->assertSee('wireProperty:', false);
    }

    #[Test]
    public function it_supports_wire_model_blur()
    {
        $view = $this->blade('<x-slate::input-otp name="code" wire:model.blur="code" />');

        // wire:model attributes are detected but not rendered on container
        $view->assertSee('wireProperty:', false);
    }

    #[Test]
    public function it_links_label_and_help_via_aria_describedby()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" label="OTP" help="Enter code" />');

        $view->assertSee('aria-describedby', false);
        $view->assertSee('input-otp-otp-help', false);
    }

    #[Test]
    public function it_links_error_via_aria_describedby()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" errorMessage="Invalid" />');

        $view->assertSee('aria-describedby', false);
        $view->assertSee('input-otp-otp-error', false);
    }

    #[Test]
    public function it_links_both_help_and_error_via_aria_describedby()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" help="Enter code" errorMessage="Invalid" />');

        $view->assertSee('aria-describedby', false);
        $view->assertSee('input-otp-otp-help', false);
        $view->assertSee('input-otp-otp-error', false);
    }

    #[Test]
    public function it_passes_error_state_to_label()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" label="OTP" errorMessage="Invalid" />');

        $view->assertSee('text-danger', false);
    }

    #[Test]
    public function it_limits_length_to_maximum_10()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" length="20" />');

        // Should limit to 10
        $view->assertSee('id="input-otp-otp-9"', false);
        $view->assertDontSee('id="input-otp-otp-10"', false);
    }

    #[Test]
    public function it_limits_length_to_minimum_1()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" length="0" />');

        // Should default to at least 1
        $view->assertSee('id="input-otp-otp-0"', false);
    }

    #[Test]
    public function it_renders_with_custom_classes()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" class="custom-class" />');

        // Custom classes are merged with container classes
        $view->assertSee('custom-class', false);
    }

    #[Test]
    public function it_renders_inputs_in_flex_container()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" />');

        $view->assertSee('flex items-center justify-center gap-2', false);
    }

    #[Test]
    public function it_includes_autocomplete_off()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" />');

        $view->assertSee('autocomplete="off"', false);
    }

    #[Test]
    public function it_includes_inputmode_text()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" />');

        $view->assertSee('inputmode="text"', false);
    }

    #[Test]
    public function it_renders_centered_text()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" />');

        $view->assertSee('text-center', false);
    }

    #[Test]
    public function it_renders_help_text_centered()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" help="Enter code" />');

        $view->assertSee('text-center', false);
    }

    #[Test]
    public function it_renders_error_text_centered()
    {
        $view = $this->blade('<x-slate::input-otp name="otp" errorMessage="Invalid" />');

        $view->assertSee('text-center', false);
    }
}

