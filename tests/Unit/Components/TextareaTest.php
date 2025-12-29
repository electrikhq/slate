<?php

namespace Electrik\Slate\Tests\Unit\Components;

use Electrik\Slate\Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\Test;

class TextareaTest extends TestCase
{
    #[Test]
    public function it_renders_a_default_textarea()
    {
        $view = $this->blade('<x-slate::textarea />');

        $view->assertSee('<textarea', false);
        $view->assertSee('border-input');
        $view->assertSee('bg-background');
        $view->assertSee('px-3');
        $view->assertSee('min-h-[80px]');
    }

    #[Test]
    public function it_renders_textarea_with_name()
    {
        $view = $this->blade('<x-slate::textarea name="description" />');

        $view->assertSee('name="description"', false);
    }

    #[Test]
    public function it_renders_textarea_with_id()
    {
        $view = $this->blade('<x-slate::textarea id="my-textarea" />');

        $view->assertSee('id="my-textarea"', false);
    }

    #[Test]
    public function it_generates_id_from_name_if_not_provided()
    {
        $view = $this->blade('<x-slate::textarea name="description" />');

        $view->assertSee('id="textarea-description"', false);
    }

    #[Test]
    public function it_renders_textarea_with_placeholder()
    {
        $view = $this->blade('<x-slate::textarea placeholder="Enter your description" />');

        $view->assertSee('placeholder="Enter your description"', false);
    }

    #[Test]
    public function it_renders_textarea_with_rows()
    {
        $view = $this->blade('<x-slate::textarea rows="5" />');

        $view->assertSee('rows="5"', false);
    }

    #[Test]
    public function it_renders_textarea_with_default_rows()
    {
        $view = $this->blade('<x-slate::textarea />');

        $view->assertSee('rows="3"', false);
    }

    #[Test]
    public function it_renders_textarea_with_cols()
    {
        $view = $this->blade('<x-slate::textarea cols="50" />');

        $view->assertSee('cols="50"', false);
    }

    #[Test]
    public function it_renders_small_textarea()
    {
        $view = $this->blade('<x-slate::textarea size="sm" />');

        $view->assertSee('px-2.5');
        $view->assertSee('text-sm');
        $view->assertSee('min-h-[72px]');
    }

    #[Test]
    public function it_renders_large_textarea()
    {
        $view = $this->blade('<x-slate::textarea size="lg" />');

        $view->assertSee('px-4');
        $view->assertSee('text-sm');
        $view->assertSee('min-h-[88px]');
    }

    #[Test]
    public function it_renders_default_size_textarea()
    {
        $view = $this->blade('<x-slate::textarea size="default" />');

        $view->assertSee('px-3');
        $view->assertSee('min-h-[80px]');
    }

    #[Test]
    public function it_renders_disabled_textarea()
    {
        $view = $this->blade('<x-slate::textarea disabled />');

        $view->assertSee('disabled', false);
        $view->assertSee('disabled:cursor-not-allowed');
        $view->assertSee('disabled:opacity-50');
    }

    #[Test]
    public function it_renders_readonly_textarea()
    {
        $view = $this->blade('<x-slate::textarea readonly />');

        $view->assertSee('readonly', false);
    }

    #[Test]
    public function it_renders_required_textarea()
    {
        $view = $this->blade('<x-slate::textarea required />');

        $view->assertSee('required', false);
        $view->assertSee('aria-required="true"', false);
    }

    #[Test]
    public function it_renders_autofocus_textarea()
    {
        $view = $this->blade('<x-slate::textarea autofocus />');

        $view->assertSee('autofocus', false);
    }

    #[Test]
    public function it_renders_textarea_with_focus_visible_classes()
    {
        $view = $this->blade('<x-slate::textarea />');

        $view->assertSee('focus-visible:outline-none');
        $view->assertSee('focus-visible:ring-2');
        $view->assertSee('focus-visible:ring-ring');
        $view->assertSee('focus-visible:ring-offset-2');
    }

    #[Test]
    public function it_renders_textarea_with_placeholder_styling()
    {
        $view = $this->blade('<x-slate::textarea placeholder="Enter text" />');

        $view->assertSee('placeholder:text-muted-foreground');
    }

    #[Test]
    public function it_renders_textarea_with_resize_y()
    {
        $view = $this->blade('<x-slate::textarea />');

        $view->assertSee('resize-y');
    }

    #[Test]
    public function it_renders_textarea_with_transition_colors()
    {
        $view = $this->blade('<x-slate::textarea />');

        $view->assertSee('transition-colors');
    }

    #[Test]
    public function it_renders_textarea_with_custom_attributes()
    {
        $view = $this->blade('<x-slate::textarea class="custom-class" data-test="value" />');

        $view->assertSee('custom-class', false);
        $view->assertSee('data-test="value"', false);
    }

    #[Test]
    public function it_renders_textarea_with_validation_error()
    {
        $validator = Validator::make(['description' => ''], [
            'description' => 'required|min:10',
        ]);

        // Share errors with view
        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::textarea name="description" />');

        $view->assertSee('border-danger');
        $view->assertSee('focus-visible:ring-danger');
        $view->assertSee('aria-invalid="true"', false);
    }

    #[Test]
    public function it_displays_error_message_when_validation_fails()
    {
        $validator = Validator::make(['description' => ''], [
            'description' => 'required|min:10',
        ]);

        // Share errors with view
        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::textarea name="description" />');

        $view->assertSee('text-danger');
        // Error message should be present
        $view->assertSee('description', false);
    }

    #[Test]
    public function it_displays_help_text_when_provided()
    {
        $view = $this->blade('<x-slate::textarea name="description" help="Enter a detailed description" />');

        $view->assertSee('Enter a detailed description', false);
        $view->assertSee('text-muted-foreground');
        $view->assertSee('id="textarea-description-help"', false);
    }

    #[Test]
    public function it_links_help_text_via_aria_describedby()
    {
        $view = $this->blade('<x-slate::textarea name="description" help="Help text" />');

        $view->assertSee('aria-describedby="textarea-description-help"', false);
    }

    #[Test]
    public function it_displays_manual_error_override()
    {
        $view = $this->blade('<x-slate::textarea name="description" errorMessage="Custom error message" />');

        $view->assertSee('border-danger');
        $view->assertSee('Custom error message', false);
        $view->assertSee('text-danger');
    }

    #[Test]
    public function it_prioritizes_manual_error_over_laravel_errors()
    {
        $validator = Validator::make(['description' => ''], [
            'description' => 'required|min:10',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::textarea name="description" errorMessage="Custom override" />');

        // Should show custom error, not Laravel error
        $view->assertSee('Custom override', false);
        $view->assertDontSee('The description field is required', false);
    }

    #[Test]
    public function it_links_both_help_and_error_via_aria_describedby()
    {
        $validator = Validator::make(['description' => ''], [
            'description' => 'required|min:10',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::textarea name="description" help="Help text" />');

        // Should have both IDs in aria-describedby
        $view->assertSee('aria-describedby', false);
        $view->assertSee('textarea-description-help', false);
        $view->assertSee('textarea-description-error', false);
    }

    #[Test]
    public function it_auto_detects_livewire_wire_model()
    {
        $view = $this->blade('<x-slate::textarea wire:model="description" name="description" />');

        // Should render wire:model attribute
        $view->assertSee('wire:model="description"', false);
    }

    #[Test]
    public function it_handles_livewire_validation_errors()
    {
        $validator = Validator::make(['description' => ''], [
            'description' => 'required|min:10',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::textarea wire:model="description" name="description" />');

        $view->assertSee('border-danger');
        $view->assertSee('aria-invalid="true"', false);
    }

    #[Test]
    public function it_uses_wire_model_property_name_for_error_detection()
    {
        $validator = Validator::make(['userDescription' => ''], [
            'userDescription' => 'required',
        ]);

        view()->share('errors', $validator->errors());

        // wire:model property name differs from name attribute
        $view = $this->blade('<x-slate::textarea wire:model="userDescription" name="description" />');

        $view->assertSee('border-danger');
        $view->assertSee('aria-invalid="true"', false);
    }

    #[Test]
    public function it_does_not_set_value_when_using_wire_model()
    {
        $view = $this->blade('<x-slate::textarea wire:model="description" value="static-value" />');

        // When using wire:model, value should not be set (Livewire handles it)
        $html = (string) $view;
        $this->assertStringNotContainsString('static-value', $html);
        $this->assertStringContainsString('wire:model="description"', $html);
    }

    #[Test]
    public function it_sets_value_when_not_using_wire_model()
    {
        $view = $this->blade('<x-slate::textarea name="description" value="static-value" />');

        $view->assertSee('static-value', false);
    }

    #[Test]
    public function it_detects_wire_model_blur()
    {
        $view = $this->blade('<x-slate::textarea wire:model.blur="description" name="description" />');

        $view->assertSee('wire:model.blur="description"', false);
    }

    #[Test]
    public function it_renders_textarea_with_integrated_label()
    {
        $view = $this->blade('<x-slate::textarea name="description" label="Description" />');

        $view->assertSee('Description');
        $view->assertSee('for="textarea-description"', false);
        $view->assertSee('<label', false);
    }

    #[Test]
    public function it_links_label_to_textarea_via_id()
    {
        $view = $this->blade('<x-slate::textarea id="custom-description" name="description" label="Description" />');

        $view->assertSee('for="custom-description"', false);
        $view->assertSee('id="custom-description"', false);
    }

    #[Test]
    public function it_passes_required_state_to_label()
    {
        $view = $this->blade('<x-slate::textarea name="description" label="Description" required />');

        $view->assertSee('Description');
        $view->assertSee('after:content-["*"]');
        $view->assertSee('after:text-danger');
    }

    #[Test]
    public function it_passes_error_state_to_label()
    {
        $validator = Validator::make(['description' => ''], [
            'description' => 'required|min:10',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::textarea name="description" label="Description" />');

        $view->assertSee('Description');
        $view->assertSee('text-danger', false);
    }

    #[Test]
    public function it_passes_size_to_label()
    {
        $view = $this->blade('<x-slate::textarea name="description" label="Description" size="sm" />');

        $view->assertSee('text-xs', false);
    }

    #[Test]
    public function it_renders_label_with_help_and_error()
    {
        $validator = Validator::make(['description' => ''], [
            'description' => 'required|min:10',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::textarea name="description" label="Description" help="Enter a detailed description" required />');

        $view->assertSee('Description');
        $view->assertSee('after:content-["*"]');
        $view->assertSee('Enter a detailed description');
        $view->assertSee('text-danger');
    }

    #[Test]
    public function it_does_not_render_label_when_not_provided()
    {
        $view = $this->blade('<x-slate::textarea name="description" />');

        $view->assertDontSee('<label', false);
    }

    #[Test]
    public function it_does_not_render_label_when_id_not_available()
    {
        $view = $this->blade('<x-slate::textarea label="Description" />');

        // Label should not render if no id/name to generate id from
        $view->assertDontSee('for="', false);
    }

    #[Test]
    public function it_renders_textarea_with_value()
    {
        $view = $this->blade('<x-slate::textarea name="description" value="Initial content" />');

        $view->assertSee('Initial content', false);
    }

    #[Test]
    public function it_renders_textarea_with_empty_value()
    {
        $view = $this->blade('<x-slate::textarea name="description" />');

        // Should render empty textarea
        $view->assertSee('</textarea>', false);
    }
}

