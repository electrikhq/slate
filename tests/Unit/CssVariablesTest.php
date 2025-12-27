<?php

namespace Electrik\Slate\Tests\Unit;

use Electrik\Slate\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CssVariablesTest extends TestCase
{
    protected function getCssContent(): string
    {
        $cssPath = __DIR__ . '/../../resources/css/slate.css';
        return file_get_contents($cssPath);
    }

    #[Test]
    public function slate_css_file_exists()
    {
        $cssPath = __DIR__ . '/../../resources/css/slate.css';
        $this->assertFileExists($cssPath);
    }

    #[Test]
    public function css_file_contains_all_base_color_variables()
    {
        $cssContent = $this->getCssContent();

        // Base colors
        $this->assertStringContainsString('--color-background:', $cssContent);
        $this->assertStringContainsString('--color-foreground:', $cssContent);
        $this->assertStringContainsString('--color-border:', $cssContent);
        $this->assertStringContainsString('--color-input:', $cssContent);
        $this->assertStringContainsString('--color-ring:', $cssContent);
    }

    #[Test]
    public function css_file_contains_all_semantic_color_variables()
    {
        $cssContent = $this->getCssContent();

        // Semantic colors
        $this->assertStringContainsString('--color-primary:', $cssContent);
        $this->assertStringContainsString('--color-primary-foreground:', $cssContent);
        $this->assertStringContainsString('--color-secondary:', $cssContent);
        $this->assertStringContainsString('--color-secondary-foreground:', $cssContent);
        $this->assertStringContainsString('--color-success:', $cssContent);
        $this->assertStringContainsString('--color-success-foreground:', $cssContent);
        $this->assertStringContainsString('--color-warning:', $cssContent);
        $this->assertStringContainsString('--color-warning-foreground:', $cssContent);
        $this->assertStringContainsString('--color-info:', $cssContent);
        $this->assertStringContainsString('--color-info-foreground:', $cssContent);
        $this->assertStringContainsString('--color-error:', $cssContent);
        $this->assertStringContainsString('--color-error-foreground:', $cssContent);
        $this->assertStringContainsString('--color-danger:', $cssContent);
        $this->assertStringContainsString('--color-danger-foreground:', $cssContent);
    }

    #[Test]
    public function css_file_contains_dark_mode_variables()
    {
        $cssContent = $this->getCssContent();

        $this->assertStringContainsString('.dark {', $cssContent);
        $this->assertStringContainsString('--color-background:', $cssContent);
    }

    #[Test]
    public function css_file_contains_utility_classes()
    {
        $cssContent = $this->getCssContent();

        $this->assertStringContainsString('@layer utilities', $cssContent);
        $this->assertStringContainsString('.bg-primary', $cssContent);
        $this->assertStringContainsString('.bg-success', $cssContent);
        $this->assertStringContainsString('.bg-warning', $cssContent);
        $this->assertStringContainsString('.bg-error', $cssContent);
        $this->assertStringContainsString('.bg-danger', $cssContent);
    }

    #[Test]
    public function css_file_contains_hover_variants()
    {
        $cssContent = $this->getCssContent();

        // Check for hover variants (CSS uses escaped colon and slash: \: and \/)
        $this->assertStringContainsString('.hover\\:bg-primary\\/90', $cssContent);
        $this->assertStringContainsString('.hover\\:bg-success\\/90', $cssContent);
        $this->assertStringContainsString('.hover\\:bg-error\\/90', $cssContent);
        $this->assertStringContainsString('.hover\\:bg-warning\\/90', $cssContent);
        $this->assertStringContainsString('.hover\\:bg-danger\\/90', $cssContent);
    }
}

