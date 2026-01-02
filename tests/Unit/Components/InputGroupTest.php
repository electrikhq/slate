<?php

namespace Electrik\Slate\Tests\Unit\Components;

use Electrik\Slate\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class InputGroupTest extends TestCase
{
    #[Test]
    public function it_renders_input_group_with_prefix()
    {
        $view = $this->blade('
            <x-slate::input-group>
                <x-slot:prefix>$</x-slot:prefix>
                <x-slate::input name="price" />
            </x-slate::input-group>
        ');

        $view->assertSee('$', false);
        $view->assertSee('name="price"', false);
        $view->assertSee('border-r');
    }

    #[Test]
    public function it_renders_input_group_with_suffix()
    {
        $view = $this->blade('
            <x-slate::input-group>
                <x-slot:suffix>.com</x-slot:suffix>
                <x-slate::input name="domain" />
            </x-slate::input-group>
        ');

        $view->assertSee('.com', false);
        $view->assertSee('name="domain"', false);
        $view->assertSee('border-l');
    }

    #[Test]
    public function it_renders_input_group_with_both_prefix_and_suffix()
    {
        $view = $this->blade('
            <x-slate::input-group>
                <x-slot:prefix>@</x-slot:prefix>
                <x-slot:suffix>.com</x-slot:suffix>
                <x-slate::input name="username" />
            </x-slate::input-group>
        ');

        $view->assertSee('@', false);
        $view->assertSee('.com', false);
        $view->assertSee('name="username"', false);
        $view->assertSee('border-r');
        $view->assertSee('border-l');
    }

    #[Test]
    public function it_renders_input_group_without_addons()
    {
        $view = $this->blade('
            <x-slate::input-group>
                <x-slate::input name="email" />
            </x-slate::input-group>
        ');

        $view->assertSee('name="email"', false);
        $view->assertSee('rounded-md');
    }

    #[Test]
    public function it_applies_size_classes_to_addons()
    {
        $view = $this->blade('
            <x-slate::input-group size="sm">
                <x-slot:prefix>$</x-slot:prefix>
                <x-slate::input name="price" />
            </x-slate::input-group>
        ');

        $view->assertSee('h-9');
    }

    #[Test]
    public function it_applies_default_size_to_addons()
    {
        $view = $this->blade('
            <x-slate::input-group>
                <x-slot:prefix>$</x-slot:prefix>
                <x-slate::input name="price" />
            </x-slate::input-group>
        ');

        $view->assertSee('h-10');
    }

    #[Test]
    public function it_applies_large_size_to_addons()
    {
        $view = $this->blade('
            <x-slate::input-group size="lg">
                <x-slot:prefix>$</x-slot:prefix>
                <x-slate::input name="price" />
            </x-slate::input-group>
        ');

        $view->assertSee('h-11');
    }

    #[Test]
    public function it_applies_disabled_state()
    {
        $view = $this->blade('
            <x-slate::input-group disabled>
                <x-slot:prefix>$</x-slot:prefix>
                <x-slate::input name="price" />
            </x-slate::input-group>
        ');

        $view->assertSee('opacity-50');
        $view->assertSee('cursor-not-allowed');
    }

    #[Test]
    public function it_applies_focus_ring_to_wrapper()
    {
        $view = $this->blade('
            <x-slate::input-group>
                <x-slot:prefix>$</x-slot:prefix>
                <x-slate::input name="price" />
            </x-slate::input-group>
        ');

        $view->assertSee('focus-within:ring-2');
        $view->assertSee('focus-within:ring-ring');
    }

    #[Test]
    public function it_applies_muted_background_to_addons()
    {
        $view = $this->blade('
            <x-slate::input-group>
                <x-slot:prefix>$</x-slot:prefix>
                <x-slate::input name="price" />
            </x-slate::input-group>
        ');

        $view->assertSee('bg-muted/50');
    }

    #[Test]
    public function it_handles_input_with_label()
    {
        $view = $this->blade('
            <x-slate::input-group>
                <x-slot:prefix>$</x-slot:prefix>
                <x-slate::input name="price" label="Price" />
            </x-slate::input-group>
        ');

        $view->assertSee('Price');
    }

    #[Test]
    public function it_handles_input_with_help_text()
    {
        $view = $this->blade('
            <x-slate::input-group>
                <x-slot:prefix>$</x-slot:prefix>
                <x-slate::input name="price" help="Enter the price" />
            </x-slate::input-group>
        ');

        $view->assertSee('Enter the price');
    }

    #[Test]
    public function it_handles_input_with_error_message()
    {
        $view = $this->blade('
            <x-slate::input-group>
                <x-slot:prefix>$</x-slot:prefix>
                <x-slate::input name="price" errorMessage="Price is required" />
            </x-slate::input-group>
        ');

        $view->assertSee('Price is required');
    }

    #[Test]
    public function it_allows_icons_in_prefix()
    {
        $view = $this->blade('
            <x-slate::input-group>
                <x-slot:prefix>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </x-slot:prefix>
                <x-slate::input name="time" />
            </x-slate::input-group>
        ');

        $view->assertSee('svg', false);
        $view->assertSee('name="time"', false);
    }

    #[Test]
    public function it_allows_icons_in_suffix()
    {
        $view = $this->blade('
            <x-slate::input-group>
                <x-slot:suffix>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </x-slot:suffix>
                <x-slate::input name="search" />
            </x-slate::input-group>
        ');

        $view->assertSee('svg', false);
        $view->assertSee('name="search"', false);
    }

    #[Test]
    public function it_removes_input_border_when_inside_group()
    {
        $view = $this->blade('
            <x-slate::input-group>
                <x-slot:prefix>$</x-slot:prefix>
                <x-slate::input name="price" />
            </x-slate::input-group>
        ');

        // Input border should be removed via CSS classes
        $view->assertSee('[&_input]:border-0');
    }

    #[Test]
    public function it_applies_proper_border_radius_with_prefix_only()
    {
        $view = $this->blade('
            <x-slate::input-group>
                <x-slot:prefix>$</x-slot:prefix>
                <x-slate::input name="price" />
            </x-slate::input-group>
        ');

        $view->assertSee('rounded-md');
        $view->assertSee('[&_input]:rounded-r-md');
    }

    #[Test]
    public function it_applies_proper_border_radius_with_suffix_only()
    {
        $view = $this->blade('
            <x-slate::input-group>
                <x-slot:suffix>.com</x-slot:suffix>
                <x-slate::input name="domain" />
            </x-slate::input-group>
        ');

        $view->assertSee('rounded-md');
        $view->assertSee('[&_input]:rounded-l-md');
    }
}

