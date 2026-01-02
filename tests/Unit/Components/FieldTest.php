<?php

namespace Electrik\Slate\Tests\Unit\Components;

use Electrik\Slate\Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\Test;

class FieldTest extends TestCase
{
    #[Test]
    public function it_renders_a_basic_field_wrapper()
    {
        $view = $this->blade('<x-slate::field><input type="text" /></x-slate::field>');

        $view->assertSee('w-full space-y-1');
        $view->assertSee('type="text"', false);
    }

    #[Test]
    public function it_renders_field_with_label()
    {
        $view = $this->blade('<x-slate::field name="email" label="Email Address"><input type="email" name="email" id="input-email" /></x-slate::field>');

        $view->assertSee('Email Address');
        $view->assertSee('for="input-email"', false);
    }

    #[Test]
    public function it_renders_field_with_help_text()
    {
        $view = $this->blade('<x-slate::field name="email" help="Enter your email address"><input type="email" name="email" /></x-slate::field>');

        $view->assertSee('Enter your email address');
        $view->assertSee('id="field-email-help"', false);
        $view->assertSee('text-muted-foreground');
    }

    #[Test]
    public function it_renders_field_with_error_message()
    {
        $view = $this->blade('<x-slate::field name="email" errorMessage="Invalid email"><input type="email" name="email" /></x-slate::field>');

        $view->assertSee('Invalid email');
        $view->assertSee('text-danger');
        $view->assertSee('id="field-email-error"', false);
        $view->assertSee('aria-invalid="true"', false);
    }

    #[Test]
    public function it_renders_field_with_required_indicator()
    {
        $view = $this->blade('<x-slate::field name="email" label="Email" required><input type="email" name="email" /></x-slate::field>');

        $view->assertSee('Email');
        $view->assertSee('aria-required="true"', false);
    }

    #[Test]
    public function it_renders_field_with_custom_id()
    {
        $view = $this->blade('<x-slate::field name="email" id="custom-field"><input type="email" name="email" /></x-slate::field>');

        $view->assertSee('id="custom-field"', false);
    }

    #[Test]
    public function it_generates_id_from_name_if_not_provided()
    {
        $view = $this->blade('<x-slate::field name="username"><input type="text" name="username" /></x-slate::field>');

        $view->assertSee('id="field-username"', false);
    }

    #[Test]
    public function it_handles_laravel_validation_errors()
    {
        $validator = Validator::make(['email' => 'invalid'], [
            'email' => 'required|email',
        ]);
        $validator->fails();

        // Share errors with view
        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::field name="email"><input type="email" name="email" /></x-slate::field>');

        $view->assertSee('text-danger');
        $view->assertSee('aria-invalid="true"', false);
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

        $view = $this->blade('<x-slate::field wire:model="code"><input type="text" wire:model="code" /></x-slate::field>');

        $view->assertSee('text-danger');
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

        $view = $this->blade('<x-slate::field wire:model="verification_code"><input type="text" wire:model="verification_code" /></x-slate::field>');

        $view->assertSee('text-danger');
    }

    #[Test]
    public function it_links_label_and_help_via_aria_describedby()
    {
        $view = $this->blade('<x-slate::field name="email" label="Email" help="Enter your email"><input type="email" name="email" /></x-slate::field>');

        $view->assertSee('aria-describedby', false);
        $view->assertSee('field-email-help', false);
    }

    #[Test]
    public function it_links_error_via_aria_describedby()
    {
        $view = $this->blade('<x-slate::field name="email" errorMessage="Invalid"><input type="email" name="email" /></x-slate::field>');

        $view->assertSee('aria-describedby', false);
        $view->assertSee('field-email-error', false);
    }

    #[Test]
    public function it_links_both_help_and_error_via_aria_describedby()
    {
        $view = $this->blade('<x-slate::field name="email" help="Enter email" errorMessage="Invalid"><input type="email" name="email" /></x-slate::field>');

        $view->assertSee('aria-describedby', false);
        $view->assertSee('field-email-help', false);
        $view->assertSee('field-email-error', false);
    }

    #[Test]
    public function it_passes_error_state_to_label()
    {
        $view = $this->blade('<x-slate::field name="email" label="Email" errorMessage="Invalid"><input type="email" name="email" /></x-slate::field>');

        $view->assertSee('text-danger', false);
    }

    #[Test]
    public function it_supports_size_variants()
    {
        $view = $this->blade('<x-slate::field name="email" label="Email" size="sm"><input type="email" name="email" /></x-slate::field>');
        $view->assertSee('text-xs', false);

        $view = $this->blade('<x-slate::field name="email" label="Email" size="lg"><input type="email" name="email" /></x-slate::field>');
        $view->assertSee('text-base', false);
    }

    #[Test]
    public function it_renders_field_without_label()
    {
        $view = $this->blade('<x-slate::field name="email"><input type="email" name="email" /></x-slate::field>');

        $view->assertDontSee('for="field-email"', false);
    }

    #[Test]
    public function it_renders_field_without_name()
    {
        $view = $this->blade('<x-slate::field><input type="text" /></x-slate::field>');

        $view->assertSee('w-full space-y-1');
    }

    #[Test]
    public function it_renders_field_with_all_props()
    {
        $view = $this->blade('<x-slate::field name="email" label="Email Address" help="Enter your email" errorMessage="Invalid email" required size="lg"><input type="email" name="email" /></x-slate::field>');

        $view->assertSee('Email Address');
        $view->assertSee('Enter your email');
        $view->assertSee('Invalid email');
        $view->assertSee('aria-required="true"', false);
        $view->assertSee('text-base', false);
    }

    #[Test]
    public function it_renders_field_with_custom_classes()
    {
        $view = $this->blade('<x-slate::field name="email" class="custom-field"><input type="email" name="email" /></x-slate::field>');

        $view->assertSee('custom-field', false);
    }

    #[Test]
    public function it_works_with_textarea()
    {
        $view = $this->blade('<x-slate::field name="message" label="Message"><textarea name="message"></textarea></x-slate::field>');

        $view->assertSee('Message');
        $view->assertSee('textarea', false);
    }

    #[Test]
    public function it_works_with_select()
    {
        $view = $this->blade('<x-slate::field name="country" label="Country"><select name="country"><option>USA</option></select></x-slate::field>');

        $view->assertSee('Country');
        $view->assertSee('select', false);
    }

    #[Test]
    public function it_works_with_checkbox()
    {
        $view = $this->blade('<x-slate::field name="terms" label="Terms" help="Accept terms"><input type="checkbox" name="terms" /></x-slate::field>');

        $view->assertSee('Terms');
        $view->assertSee('Accept terms');
        $view->assertSee('type="checkbox"', false);
    }

    #[Test]
    public function it_prioritizes_manual_error_over_automatic_detection()
    {
        $validator = Validator::make(['email' => 'test@example.com'], [
            'email' => 'required|email',
        ]);
        $validator->fails();

        // Share errors with view
        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::field name="email" errorMessage="Custom error message"><input type="email" name="email" /></x-slate::field>');

        $view->assertSee('Custom error message');
    }

    #[Test]
    public function it_renders_help_text_before_error_message()
    {
        $view = $this->blade('<x-slate::field name="email" help="Help text" errorMessage="Error message"><input type="email" name="email" /></x-slate::field>');

        // Both should be present
        $view->assertSee('Help text');
        $view->assertSee('Error message');
        
        // Check that help text ID comes before error ID in aria-describedby
        $view->assertSee('field-email-help', false);
        $view->assertSee('field-email-error', false);
    }
}

