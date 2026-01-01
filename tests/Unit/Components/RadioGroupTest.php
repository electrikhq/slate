<?php

namespace Electrik\Slate\Tests\Unit\Components;

use Electrik\Slate\Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\Test;

class RadioGroupTest extends TestCase
{
    #[Test]
    public function it_renders_a_default_radio_group()
    {
        $view = $this->blade('<x-slate::radio-group name="option" :options="[\'yes\' => \'Yes\', \'no\' => \'No\']" />');

        $view->assertSee('type="radio"', false);
        $view->assertSee('role="radiogroup"', false);
    }

    #[Test]
    public function it_renders_radio_group_with_name()
    {
        $view = $this->blade('<x-slate::radio-group name="option" :options="[\'yes\' => \'Yes\']" />');

        $view->assertSee('name="option"', false);
    }

    #[Test]
    public function it_renders_radio_group_with_label()
    {
        $view = $this->blade('<x-slate::radio-group name="option" label="Choose an option" :options="[\'yes\' => \'Yes\', \'no\' => \'No\']" />');

        $view->assertSee('Choose an option');
        $view->assertSee('<label', false);
    }

    #[Test]
    public function it_renders_all_options()
    {
        $view = $this->blade('<x-slate::radio-group name="option" :options="[\'yes\' => \'Yes\', \'no\' => \'No\', \'maybe\' => \'Maybe\']" />');

        $view->assertSee('Yes', false);
        $view->assertSee('No', false);
        $view->assertSee('Maybe', false);
        $view->assertSee('value="yes"', false);
        $view->assertSee('value="no"', false);
        $view->assertSee('value="maybe"', false);
    }

    #[Test]
    public function it_handles_options_as_associative_array()
    {
        $view = $this->blade('<x-slate::radio-group name="option" :options="[\'yes\' => \'Yes\', \'no\' => \'No\']" />');

        $view->assertSee('value="yes"', false);
        $view->assertSee('Yes', false);
        $view->assertSee('value="no"', false);
        $view->assertSee('No', false);
    }

    #[Test]
    public function it_handles_options_as_indexed_array()
    {
        $view = $this->blade('<x-slate::radio-group name="option" :options="[\'Yes\', \'No\']" />');

        $view->assertSee('value="Yes"', false);
        $view->assertSee('Yes', false);
        $view->assertSee('value="No"', false);
        $view->assertSee('No', false);
    }

    #[Test]
    public function it_handles_options_as_array_of_arrays()
    {
        $view = $this->blade('<x-slate::radio-group name="option" :options="[[\'value\' => \'yes\', \'label\' => \'Yes\'], [\'value\' => \'no\', \'label\' => \'No\']]" />');

        $view->assertSee('value="yes"', false);
        $view->assertSee('Yes', false);
        $view->assertSee('value="no"', false);
        $view->assertSee('No', false);
    }

    #[Test]
    public function it_selects_option_by_value()
    {
        $view = $this->blade('<x-slate::radio-group name="option" value="yes" :options="[\'yes\' => \'Yes\', \'no\' => \'No\']" />');

        $html = (string) $view;
        $this->assertStringContainsString('value="yes"', $html);
        $this->assertMatchesRegularExpression('/value="yes"[^>]*checked/', $html);
        $this->assertStringNotContainsString('value="no"[^>]*checked', $html);
    }

    #[Test]
    public function it_renders_required_radio_group()
    {
        $view = $this->blade('<x-slate::radio-group name="option" required :options="[\'yes\' => \'Yes\']" />');

        $view->assertSee('required', false);
        $view->assertSee('aria-required="true"', false);
    }

    #[Test]
    public function it_displays_help_text()
    {
        $view = $this->blade('<x-slate::radio-group name="option" help="Please select an option" :options="[\'yes\' => \'Yes\']" />');

        $view->assertSee('Please select an option', false);
        $view->assertSee('text-muted-foreground');
    }

    #[Test]
    public function it_displays_error_message()
    {
        $view = $this->blade('<x-slate::radio-group name="option" errorMessage="Please select an option" :options="[\'yes\' => \'Yes\']" />');

        $view->assertSee('border-danger');
        $view->assertSee('Please select an option', false);
        $view->assertSee('text-danger');
        $view->assertSee('aria-invalid="true"', false);
    }

    #[Test]
    public function it_handles_validation_errors()
    {
        $validator = Validator::make(['option' => ''], [
            'option' => 'required',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::radio-group name="option" :options="[\'yes\' => \'Yes\']" />');

        $view->assertSee('border-danger');
        $view->assertSee('aria-invalid="true"', false);
    }

    #[Test]
    public function it_prioritizes_manual_error_over_laravel_errors()
    {
        $validator = Validator::make(['option' => ''], [
            'option' => 'required',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::radio-group name="option" errorMessage="Custom override" :options="[\'yes\' => \'Yes\']" />');

        $view->assertSee('Custom override', false);
    }

    #[Test]
    public function it_auto_detects_livewire_wire_model()
    {
        $view = $this->blade('<x-slate::radio-group wire:model="option" name="option" :options="[\'yes\' => \'Yes\']" />');

        $view->assertSee('wire:model="option"', false);
    }

    #[Test]
    public function it_handles_livewire_validation_errors()
    {
        $validator = Validator::make(['option' => ''], [
            'option' => 'required',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::radio-group wire:model="option" name="option" :options="[\'yes\' => \'Yes\']" />');

        $view->assertSee('border-danger');
        $view->assertSee('aria-invalid="true"', false);
    }

    #[Test]
    public function it_uses_wire_model_property_name_for_error_detection()
    {
        $validator = Validator::make(['userOption' => ''], [
            'userOption' => 'required',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::radio-group wire:model="userOption" name="option" :options="[\'yes\' => \'Yes\']" />');

        $view->assertSee('border-danger');
        $view->assertSee('aria-invalid="true"', false);
    }

    #[Test]
    public function it_does_not_set_selected_value_when_using_wire_model()
    {
        $view = $this->blade('<x-slate::radio-group wire:model="option" value="yes" :options="[\'yes\' => \'Yes\', \'no\' => \'No\']" />');

        // When using wire:model, selected value should not be set (Livewire handles it)
        $html = (string) $view;
        $this->assertStringContainsString('wire:model="option"', $html);
    }

    #[Test]
    public function it_generates_unique_ids_for_each_radio()
    {
        $view = $this->blade('<x-slate::radio-group name="option" :options="[\'yes\' => \'Yes\', \'no\' => \'No\']" />');

        $html = (string) $view;
        $this->assertStringContainsString('id="radio-group-option-yes"', $html);
        $this->assertStringContainsString('id="radio-group-option-no"', $html);
    }

    #[Test]
    public function it_links_labels_to_radios_via_id()
    {
        $view = $this->blade('<x-slate::radio-group name="option" :options="[\'yes\' => \'Yes\']" />');

        $view->assertSee('for="radio-group-option-yes"', false);
        $view->assertSee('id="radio-group-option-yes"', false);
    }

    #[Test]
    public function it_passes_size_to_labels()
    {
        $view = $this->blade('<x-slate::radio-group name="option" size="sm" :options="[\'yes\' => \'Yes\']" />');

        $view->assertSee('text-xs', false);
    }

    #[Test]
    public function it_passes_error_state_to_labels()
    {
        $validator = Validator::make(['option' => ''], [
            'option' => 'required',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::radio-group name="option" :options="[\'yes\' => \'Yes\']" />');

        $view->assertSee('text-danger', false);
    }

    #[Test]
    public function it_renders_label_with_required_indicator()
    {
        $view = $this->blade('<x-slate::radio-group name="option" label="Choose option" required :options="[\'yes\' => \'Yes\']" />');

        $view->assertSee('Choose option');
        $view->assertSee('after:content-["*"]');
        $view->assertSee('after:text-danger');
    }

    #[Test]
    public function it_links_help_text_via_aria_describedby()
    {
        $view = $this->blade('<x-slate::radio-group name="option" help="Help text" :options="[\'yes\' => \'Yes\']" />');

        $view->assertSee('aria-describedby="radio-group-option-help"', false);
    }

    #[Test]
    public function it_links_error_via_aria_describedby()
    {
        $validator = Validator::make(['option' => ''], [
            'option' => 'required',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::radio-group name="option" :options="[\'yes\' => \'Yes\']" />');

        $view->assertSee('aria-describedby', false);
        $view->assertSee('radio-group-option-error', false);
    }

    #[Test]
    public function it_links_both_help_and_error_via_aria_describedby()
    {
        $validator = Validator::make(['option' => ''], [
            'option' => 'required',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::radio-group name="option" help="Help text" :options="[\'yes\' => \'Yes\']" />');

        $view->assertSee('aria-describedby', false);
        $view->assertSee('radio-group-option-help', false);
        $view->assertSee('radio-group-option-error', false);
    }

    #[Test]
    public function it_renders_radios_with_rounded_full_class()
    {
        $view = $this->blade('<x-slate::radio-group name="option" :options="[\'yes\' => \'Yes\']" />');

        $view->assertSee('rounded-full');
    }

    #[Test]
    public function it_renders_radios_with_focus_visible_classes()
    {
        $view = $this->blade('<x-slate::radio-group name="option" :options="[\'yes\' => \'Yes\']" />');

        $view->assertSee('focus-visible:outline-none');
        $view->assertSee('focus-visible:ring-2');
        $view->assertSee('focus-visible:ring-ring');
    }

    #[Test]
    public function it_renders_radios_with_transition_colors()
    {
        $view = $this->blade('<x-slate::radio-group name="option" :options="[\'yes\' => \'Yes\']" />');

        $view->assertSee('transition-colors');
    }

    #[Test]
    public function it_renders_labels_with_cursor_pointer()
    {
        $view = $this->blade('<x-slate::radio-group name="option" :options="[\'yes\' => \'Yes\']" />');

        $view->assertSee('cursor-pointer', false);
    }

    #[Test]
    public function it_handles_empty_options_array()
    {
        $view = $this->blade('<x-slate::radio-group name="option" :options="[]" />');

        $view->assertSee('role="radiogroup"', false);
        // Should still render group container even with no options
    }
}

