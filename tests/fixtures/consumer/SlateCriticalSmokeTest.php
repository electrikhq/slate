<?php

namespace Tests\Feature;

use Tests\TestCase;

class SlateCriticalSmokeTest extends TestCase
{
    public function test_critical_components_page_renders(): void
    {
        $response = $this->get('/slate-critical');

        $response->assertOk();
        $response->assertSee('Critical components', false);
        $response->assertSee('Save changes', false);
        $response->assertSee('Please enter a valid email address.', false);
        $response->assertSee('Open dialog', false);
        $response->assertSee('Edit profile', false);
        $response->assertSee('Show toast', false);
        $response->assertSee('data-slot="app-shell"', false);
        $response->assertSee('data-slot="toaster"', false);
        $response->assertSee('slate-toast', false);
    }
}
