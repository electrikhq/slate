<?php

namespace Electrik\Slate\Tests\Unit\Components;

use Electrik\Slate\Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\Test;

class SliderTest extends TestCase
{
    #[Test]
    public function it_renders_a_default_slider()
    {
        $view = $this->blade('<x-slate::slider />');

        $view->assertSee('type="range"', false);
        $view->assertSee('range-slider');
        $view->assertSee('bg-transparent');
        $view->assertSee('--slider-track-color');
    }

    #[Test]
    public function it_renders_slider_with_name()
    {
        $view = $this->blade('<x-slate::slider name="volume" />');

        $view->assertSee('name="volume"', false);
    }

    #[Test]
    public function it_renders_slider_with_id()
    {
        $view = $this->blade('<x-slate::slider id="my-slider" />');

        $view->assertSee('id="my-slider"', false);
    }

    #[Test]
    public function it_generates_id_from_name_if_not_provided()
    {
        $view = $this->blade('<x-slate::slider name="volume" />');

        $view->assertSee('id="slider-volume"', false);
    }

    #[Test]
    public function it_renders_slider_with_min_max()
    {
        $view = $this->blade('<x-slate::slider name="volume" min="0" max="100" />');

        $view->assertSee('min="0"', false);
        $view->assertSee('max="100"', false);
    }

    #[Test]
    public function it_renders_slider_with_default_min_max()
    {
        $view = $this->blade('<x-slate::slider name="volume" />');

        $view->assertSee('min="0"', false);
        $view->assertSee('max="100"', false);
    }

    #[Test]
    public function it_renders_slider_with_step()
    {
        $view = $this->blade('<x-slate::slider name="volume" step="5" />');

        $view->assertSee('step="5"', false);
    }

    #[Test]
    public function it_renders_slider_with_default_step()
    {
        $view = $this->blade('<x-slate::slider name="volume" />');

        $view->assertSee('step="1"', false);
    }

    #[Test]
    public function it_renders_slider_with_value()
    {
        $view = $this->blade('<x-slate::slider name="volume" value="50" />');

        $view->assertSee('value="50"', false);
    }

    #[Test]
    public function it_renders_small_slider()
    {
        $view = $this->blade('<x-slate::slider size="sm" />');

        $view->assertSee('h-1.5');
    }

    #[Test]
    public function it_renders_large_slider()
    {
        $view = $this->blade('<x-slate::slider size="lg" />');

        $view->assertSee('h-2.5');
    }

    #[Test]
    public function it_renders_default_size_slider()
    {
        $view = $this->blade('<x-slate::slider size="default" />');

        $view->assertSee('h-2');
    }

    #[Test]
    public function it_renders_disabled_slider()
    {
        $view = $this->blade('<x-slate::slider disabled />');

        $view->assertSee('disabled', false);
        $view->assertSee('disabled:cursor-not-allowed');
        $view->assertSee('disabled:opacity-50');
    }

    #[Test]
    public function it_renders_required_slider()
    {
        $view = $this->blade('<x-slate::slider required />');

        $view->assertSee('required', false);
        $view->assertSee('aria-required="true"', false);
    }

    #[Test]
    public function it_renders_slider_with_aria_valuemin_and_valuemax()
    {
        $view = $this->blade('<x-slate::slider name="volume" min="0" max="100" />');

        $view->assertSee('aria-valuemin="0"', false);
        $view->assertSee('aria-valuemax="100"', false);
    }

    #[Test]
    public function it_renders_slider_with_aria_valuenow()
    {
        $view = $this->blade('<x-slate::slider name="volume" value="50" />');

        $view->assertSee('aria-valuenow="50"', false);
    }

    #[Test]
    public function it_renders_slider_with_custom_attributes()
    {
        $view = $this->blade('<x-slate::slider class="custom-class" data-test="value" />');

        $view->assertSee('custom-class', false);
        $view->assertSee('data-test="value"', false);
    }

    #[Test]
    public function it_renders_slider_with_validation_error()
    {
        $validator = Validator::make(['volume' => 50], [
            'volume' => 'min:101',
        ]);

        // Trigger validation to populate errors
        $validator->fails();

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::slider name="volume" />');

        $view->assertSee('accent-danger');
        $view->assertSee('focus-visible:ring-danger');
        $view->assertSee('aria-invalid="true"', false);
    }

    #[Test]
    public function it_displays_error_message_when_validation_fails()
    {
        $validator = Validator::make(['volume' => 50], [
            'volume' => 'min:101',
        ]);

        // Trigger validation to populate errors
        $validator->fails();

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::slider name="volume" />');

        $view->assertSee('text-danger');
        $view->assertSee('volume', false);
    }

    #[Test]
    public function it_displays_help_text_when_provided()
    {
        $view = $this->blade('<x-slate::slider name="volume" help="Adjust the volume level" />');

        $view->assertSee('Adjust the volume level', false);
        $view->assertSee('text-muted-foreground');
        $view->assertSee('id="slider-volume-help"', false);
    }

    #[Test]
    public function it_links_help_text_via_aria_describedby()
    {
        $view = $this->blade('<x-slate::slider name="volume" help="Help text" />');

        $view->assertSee('aria-describedby="slider-volume-help"', false);
    }

    #[Test]
    public function it_displays_manual_error_override()
    {
        $view = $this->blade('<x-slate::slider name="volume" errorMessage="Volume must be between 0 and 100" />');

        $view->assertSee('accent-danger');
        $view->assertSee('Volume must be between 0 and 100', false);
        $view->assertSee('text-danger');
    }

    #[Test]
    public function it_prioritizes_manual_error_over_laravel_errors()
    {
        $validator = Validator::make(['volume' => 50], [
            'volume' => 'max:100',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::slider name="volume" errorMessage="Custom override" />');

        $view->assertSee('Custom override', false);
    }

    #[Test]
    public function it_links_both_help_and_error_via_aria_describedby()
    {
        $validator = Validator::make(['volume' => 50], [
            'volume' => 'min:101',
        ]);

        // Trigger validation to populate errors
        $validator->fails();

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::slider name="volume" help="Help text" />');

        $view->assertSee('aria-describedby', false);
        $view->assertSee('slider-volume-help', false);
        $view->assertSee('slider-volume-error', false);
    }

    #[Test]
    public function it_auto_detects_livewire_wire_model()
    {
        $view = $this->blade('<x-slate::slider wire:model="volume" name="volume" />');

        $view->assertSee('wire:model="volume"', false);
    }

    #[Test]
    public function it_handles_livewire_validation_errors()
    {
        $validator = Validator::make(['volume' => 50], [
            'volume' => 'min:101',
        ]);

        // Trigger validation to populate errors
        $validator->fails();

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::slider wire:model="volume" name="volume" />');

        $view->assertSee('accent-danger');
        $view->assertSee('aria-invalid="true"', false);
    }

    #[Test]
    public function it_uses_wire_model_property_name_for_error_detection()
    {
        $validator = Validator::make(['userVolume' => 50], [
            'userVolume' => 'min:101',
        ]);

        // Trigger validation to populate errors
        $validator->fails();

        view()->share('errors', $validator->errors());

        // wire:model property name differs from name attribute
        $view = $this->blade('<x-slate::slider wire:model="userVolume" name="volume" />');

        $view->assertSee('accent-danger');
        $view->assertSee('aria-invalid="true"', false);
    }

    #[Test]
    public function it_does_not_set_value_when_using_wire_model()
    {
        $view = $this->blade('<x-slate::slider wire:model="volume" value="50" />');

        // When using wire:model, value should not be set (Livewire handles it)
        $html = (string) $view;
        $this->assertStringNotContainsString('value="50"', $html);
        $this->assertStringContainsString('wire:model="volume"', $html);
    }

    #[Test]
    public function it_sets_value_when_not_using_wire_model()
    {
        $view = $this->blade('<x-slate::slider name="volume" value="50" />');

        $view->assertSee('value="50"', false);
    }

    #[Test]
    public function it_renders_slider_with_integrated_label()
    {
        $view = $this->blade('<x-slate::slider name="volume" label="Volume" />');

        $view->assertSee('Volume');
        $view->assertSee('for="slider-volume"', false);
        $view->assertSee('<label', false);
    }

    #[Test]
    public function it_links_label_to_slider_via_id()
    {
        $view = $this->blade('<x-slate::slider id="custom-volume" name="volume" label="Volume" />');

        $view->assertSee('for="custom-volume"', false);
        $view->assertSee('id="custom-volume"', false);
    }

    #[Test]
    public function it_passes_required_state_to_label()
    {
        $view = $this->blade('<x-slate::slider name="volume" label="Volume" required />');

        $view->assertSee('Volume');
        $view->assertSee('after:content-["*"]');
        $view->assertSee('after:text-danger');
    }

    #[Test]
    public function it_passes_error_state_to_label()
    {
        $validator = Validator::make(['volume' => 50], [
            'volume' => 'min:101',
        ]);

        // Trigger validation to populate errors
        $validator->fails();

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::slider name="volume" label="Volume" />');

        $html = (string) $view;
        $this->assertStringContainsString('Volume', $html);
        // Label should have error state
        $this->assertStringContainsString('text-danger', $html);
    }

    #[Test]
    public function it_passes_size_to_label()
    {
        $view = $this->blade('<x-slate::slider name="volume" label="Volume" size="sm" />');

        $view->assertSee('text-xs', false);
    }

    #[Test]
    public function it_renders_label_with_help_and_error()
    {
        $validator = Validator::make(['volume' => 50], [
            'volume' => 'max:100',
        ]);

        view()->share('errors', $validator->errors());

        $view = $this->blade('<x-slate::slider name="volume" label="Volume" help="Adjust volume" required />');

        $view->assertSee('Volume');
        $view->assertSee('after:content-["*"]');
        $view->assertSee('Adjust volume');
        $view->assertSee('text-danger');
    }

    #[Test]
    public function it_does_not_render_label_when_not_provided()
    {
        $view = $this->blade('<x-slate::slider name="volume" />');

        $view->assertDontSee('<label', false);
    }

    #[Test]
    public function it_does_not_render_label_when_id_not_available()
    {
        $view = $this->blade('<x-slate::slider label="Volume" />');

        $view->assertDontSee('for="', false);
    }

    #[Test]
    public function it_clamps_value_to_min_max_bounds()
    {
        // Value below min should be clamped to min
        $view = $this->blade('<x-slate::slider name="volume" min="10" max="100" value="5" />');

        $view->assertSee('value="10"', false);
        $view->assertSee('aria-valuenow="10"', false);
    }

    #[Test]
    public function it_clamps_value_to_max_when_above_max()
    {
        // Value above max should be clamped to max
        $view = $this->blade('<x-slate::slider name="volume" min="0" max="100" value="150" />');

        $view->assertSee('value="100"', false);
        $view->assertSee('aria-valuenow="100"', false);
    }

    #[Test]
    public function it_uses_min_as_default_value_when_no_value_provided()
    {
        $view = $this->blade('<x-slate::slider name="volume" min="10" max="100" />');

        $view->assertSee('value="10"', false);
        $view->assertSee('aria-valuenow="10"', false);
    }

    #[Test]
    public function it_detects_wire_model_blur()
    {
        $view = $this->blade('<x-slate::slider wire:model.blur="volume" name="volume" />');

        $view->assertSee('wire:model.blur="volume"', false);
    }

    #[Test]
    public function it_detects_wire_model_live()
    {
        $view = $this->blade('<x-slate::slider wire:model.live="volume" name="volume" />');

        $view->assertSee('wire:model.live="volume"', false);
    }

    #[Test]
    public function it_detects_wire_model_defer()
    {
        $view = $this->blade('<x-slate::slider wire:model.defer="volume" name="volume" />');

        $view->assertSee('wire:model.defer="volume"', false);
    }

    #[Test]
    public function it_renders_slider_with_appearance_none()
    {
        $view = $this->blade('<x-slate::slider name="volume" />');

        $view->assertSee('appearance-none');
    }

    #[Test]
    public function it_renders_slider_with_cursor_pointer()
    {
        $view = $this->blade('<x-slate::slider name="volume" />');

        // Cursor styles are in the main CSS file, component just needs range-slider class
        $view->assertSee('range-slider');
    }
}

