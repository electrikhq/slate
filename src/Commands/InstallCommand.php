<?php

namespace Electrik\Slate\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slate:install 
                            {--publish-views : Publish component views for customization}
                            {--force : Overwrite existing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Slate UI Kit';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Installing Slate UI Kit...');
        $this->newLine();

        $this->copyCssFile();
        $this->updateAppCss();
        $this->updateTailwindConfig();

        if ($this->option('publish-views')) {
            $this->publishViews();
        }

        $this->newLine();
        $this->info('✅ Slate UI Kit installed successfully!');
        $this->info('📚 Documentation: https://slate.electrik.dev');
        $this->newLine();

        return self::SUCCESS;
    }

    /**
     * Copy slate.css to resources/css directory.
     */
    protected function copyCssFile(): void
    {
        $source = __DIR__ . '/../../resources/css/slate.css';
        $destination = resource_path('css/slate.css');

        if (File::exists($destination) && !$this->option('force')) {
            if (!$this->confirm('slate.css already exists. Overwrite?', false)) {
                $this->info('Skipping CSS file copy.');
                return;
            }
        }

        File::ensureDirectoryExists(resource_path('css'));
        File::copy($source, $destination);

        $this->info('✅ Copied slate.css to resources/css/slate.css');
    }

    /**
     * Update app.css to import slate.css and add @source directive.
     * 
     * IMPORTANT: slate.css must be imported AFTER tailwindcss to ensure
     * Tailwind's theme variables (like --spacing) are available when our
     * custom utilities in @layer utilities are processed.
     */
    protected function updateAppCss(): void
    {
        $appCssPath = resource_path('css/app.css');

        if (!File::exists($appCssPath)) {
            File::put($appCssPath, "@import 'tailwindcss';\n@import './slate.css';\n\n@source '../../vendor/electrik/slate/resources/views/**/*.blade.php';\n");
            $this->info('✅ Created resources/css/app.css');
            return;
        }

        $content = File::get($appCssPath);
        $modified = false;

        // Check if slate.css import already exists (check for both formats)
        if (!str_contains($content, '@import "./slate.css"') && !str_contains($content, "@import './slate.css'") && 
            !str_contains($content, '@import "slate.css"') && !str_contains($content, "@import 'slate.css'")) {
            // Add import AFTER tailwindcss import
            if (str_contains($content, '@import "tailwindcss"') || str_contains($content, "@import 'tailwindcss'")) {
                // Find the tailwindcss import and add slate.css after it
                $lines = explode("\n", $content);
                $insertIndex = null;
                foreach ($lines as $index => $line) {
                    if (str_contains($line, '@import "tailwindcss"') || str_contains($line, "@import 'tailwindcss'")) {
                        $insertIndex = $index + 1;
                        break;
                    }
                }
                if ($insertIndex !== null) {
                    array_splice($lines, $insertIndex, 0, '@import "./slate.css";');
                    $content = implode("\n", $lines);
                    $modified = true;
                } else {
                    // Fallback: add at end
                    $content .= "\n@import './slate.css';";
                    $modified = true;
                }
            } else {
                // No tailwindcss import found, add both
                $content = $content . "\n@import 'tailwindcss';\n@import './slate.css';";
                $modified = true;
            }
        }

        // Add @source directive for Slate components if not present
        $slateSourcePattern = "@source '../../vendor/electrik/slate/resources/views/**/*.blade.php'";
        if (!str_contains($content, $slateSourcePattern) && 
            (!str_contains($content, '@source') || 
             (str_contains($content, '@source') && !str_contains($content, 'electrik/slate')))) {
            // Find where to insert @source directive (after @import statements, before @theme if exists)
            $lines = explode("\n", $content);
            $insertIndex = null;
            foreach ($lines as $index => $line) {
                // Insert after the last @import or @source line
                if (str_starts_with(trim($line), '@import') || str_starts_with(trim($line), '@source')) {
                    $insertIndex = $index + 1;
                }
            }
            if ($insertIndex !== null) {
                array_splice($lines, $insertIndex, 0, $slateSourcePattern . ';');
                $content = implode("\n", $lines);
                $modified = true;
            } else {
                // Fallback: add after imports
                $content = preg_replace('/(@import[^\n]+\n)+/', '$0' . $slateSourcePattern . ";\n", $content, 1);
                $modified = true;
            }
        }

        if ($modified) {
            File::put($appCssPath, $content);
            $this->info('✅ Updated resources/css/app.css');
        } else {
            $this->info('✅ app.css already configured correctly');
        }
    }

    /**
     * Update tailwind.config.js with Slate color definitions.
     */
    protected function updateTailwindConfig(): void
    {
        $configPath = base_path('tailwind.config.js');

        if (!File::exists($configPath)) {
            $this->warn('⚠️  tailwind.config.js not found. Please manually add Slate colors to your Tailwind config.');
            $this->displayTailwindConfigInstructions();
            return;
        }

        $content = File::get($configPath);

        // Check if Slate colors already exist
        if (str_contains($content, '--color-primary') || str_contains($content, 'slate')) {
            $this->info('✅ Tailwind config already contains Slate colors');
            return;
        }

        // Try to add colors to theme.extend.colors
        // This is a simple approach - users may need to adjust based on their config structure
        $this->warn('⚠️  Please manually add Slate colors to your tailwind.config.js');
        $this->displayTailwindConfigInstructions();
    }

    /**
     * Display instructions for adding Tailwind config.
     */
    protected function displayTailwindConfigInstructions(): void
    {
        $this->newLine();
        $this->info('Add the following to your tailwind.config.js:');
        $this->newLine();
        $this->line('theme: {');
        $this->line('  extend: {');
        $this->line('    colors: {');
        $this->line('      border: "hsl(var(--color-border))",');
        $this->line('      input: "hsl(var(--color-input))",');
        $this->line('      ring: "hsl(var(--color-ring))",');
        $this->line('      background: "hsl(var(--color-background))",');
        $this->line('      foreground: "hsl(var(--color-foreground))",');
        $this->line('      primary: {');
        $this->line('        DEFAULT: "hsl(var(--color-primary))",');
        $this->line('        foreground: "hsl(var(--color-primary-foreground))",');
        $this->line('      },');
        $this->line('      // ... (see documentation for full config)');
        $this->line('    },');
        $this->line('  },');
        $this->line('},');
        $this->newLine();
    }

    /**
     * Publish component views.
     */
    protected function publishViews(): void
    {
        $this->call('vendor:publish', [
            '--tag' => 'slate-views',
            '--force' => $this->option('force'),
        ]);

        $this->info('✅ Published component views to resources/views/vendor/slate');
    }
}

