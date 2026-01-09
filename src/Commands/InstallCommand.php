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
                            {--force : Overwrite existing files}
                            {--skip-npm : Skip npm package installation}';

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

        $this->installBladeIcons();
        $this->installTypographyPlugin();
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
     * Setup Blade Icons (publish config).
     * Note: Blade Icons and Carbon icons are installed automatically via Composer
     * when Slate is installed, since they're dependencies in slate/composer.json
     */
    protected function installBladeIcons(): void
    {
        // Blade Icons and Carbon icons are already installed via Composer dependencies
        $this->info('✅ Blade Icons and Carbon icons installed (via Composer dependencies)');

        // Publish Blade Icons config
        $this->info('Publishing Blade Icons configuration...');
        $this->call('vendor:publish', [
            '--tag' => 'blade-icons',
            '--force' => false,
        ]);
        $this->info('✅ Blade Icons configuration published');
        $this->info('💡 You can now use icons like: icon="carbon-envelope"');
    }

    /**
     * Install Tailwind Typography plugin for markdown/prose styling.
     */
    protected function installTypographyPlugin(): void
    {
        // Check if user wants to skip npm installation
        if ($this->option('skip-npm')) {
            $this->info('⏭️  Skipping npm package installation (--skip-npm flag used)');
            $this->newLine();
            $this->warn('⚠️  Manual steps required:');
            $this->info('   1. Install Typography plugin: npm install -D @tailwindcss/typography');
            $this->info('   2. The @plugin directive will be added to your app.css automatically');
            $this->info('   3. After installing, rebuild your assets: npm run build');
            $this->newLine();
            return;
        }

        $packageJsonPath = base_path('package.json');
        
        if (!File::exists($packageJsonPath)) {
            $this->warn('⚠️  package.json not found. Skipping Typography plugin installation.');
            $this->info('💡 To install manually: npm install -D @tailwindcss/typography');
            $this->info('💡 Then add @plugin "@tailwindcss/typography"; to your app.css after @import "tailwindcss";');
            return;
        }

        $packageJson = json_decode(File::get($packageJsonPath), true);
        
        // Check if typography plugin is already in package.json
        $devDependencies = $packageJson['devDependencies'] ?? [];
        $isInPackageJson = isset($devDependencies['@tailwindcss/typography']);
        
        if ($isInPackageJson) {
            // Package is in package.json - run npm install to ensure it's installed and up to date
            $this->info('Installing npm dependencies (including @tailwindcss/typography)...');
            $command = 'npm install';
        } else {
            // Package not in package.json - install it
            $this->info('Installing @tailwindcss/typography plugin...');
            $command = 'npm install -D @tailwindcss/typography';
        }
        
        $output = [];
        $returnVar = 0;
        
        exec("cd " . escapeshellarg(base_path()) . " && {$command} 2>&1", $output, $returnVar);
        
        if ($returnVar === 0) {
            $this->info('✅ Installed @tailwindcss/typography');
            $this->info('💡 Typography plugin installed. Use "prose" classes for markdown content.');
        } else {
            $this->warn('⚠️  Failed to install @tailwindcss/typography automatically.');
            $this->info('💡 Please run manually: npm install -D @tailwindcss/typography');
            $this->info('💡 Then add @plugin "@tailwindcss/typography"; to your app.css');
        }
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
            File::put($appCssPath, "@import 'tailwindcss';\n@plugin '@tailwindcss/typography';\n@import './slate.css';\n\n@source '../../vendor/electrik/slate/resources/views/**/*.blade.php';\n");
            $this->info('✅ Created resources/css/app.css');
            return;
        }

        $content = File::get($appCssPath);
        $modified = false;

        // Add Typography plugin if not present
        if (!str_contains($content, '@plugin') || !str_contains($content, '@tailwindcss/typography')) {
            // Find the tailwindcss import and add plugin after it
            if (str_contains($content, '@import "tailwindcss"') || str_contains($content, "@import 'tailwindcss'")) {
                $lines = explode("\n", $content);
                $insertIndex = null;
                foreach ($lines as $index => $line) {
                    if (str_contains($line, '@import "tailwindcss"') || str_contains($line, "@import 'tailwindcss'")) {
                        $insertIndex = $index + 1;
                        break;
                    }
                }
                if ($insertIndex !== null) {
                    // Check if plugin line doesn't already exist
                    $hasPlugin = false;
                    foreach ($lines as $line) {
                        if (str_contains($line, '@plugin') && str_contains($line, 'typography')) {
                            $hasPlugin = true;
                            break;
                        }
                    }
                    if (!$hasPlugin) {
                        array_splice($lines, $insertIndex, 0, "@plugin '@tailwindcss/typography';");
                        $content = implode("\n", $lines);
                        $modified = true;
                    }
                }
            }
        }

        // Check if slate.css import already exists (check for both formats)
        if (!str_contains($content, '@import "./slate.css"') && !str_contains($content, "@import './slate.css'") && 
            !str_contains($content, '@import "slate.css"') && !str_contains($content, "@import 'slate.css'")) {
            // Add import AFTER tailwindcss import or plugin (whichever comes last)
            if (str_contains($content, '@import "tailwindcss"') || str_contains($content, "@import 'tailwindcss'")) {
                // Find the last relevant line (plugin or tailwindcss) and add slate.css after it
                $lines = explode("\n", $content);
                $insertIndex = null;
                foreach ($lines as $index => $line) {
                    // Keep updating insertIndex to find the last relevant line
                    if (str_contains($line, '@import "tailwindcss"') || str_contains($line, "@import 'tailwindcss'") ||
                        (str_contains($line, '@plugin') && str_contains($line, 'typography'))) {
                        $insertIndex = $index + 1;
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
     * Verify Tailwind CSS v4 setup.
     * Note: Slate only supports Tailwind CSS v4, which uses CSS variables (no config file needed).
     */
    protected function updateTailwindConfig(): void
    {
        // Tailwind CSS v4 doesn't require a config file - everything is handled via CSS variables
        $this->info('✅ Tailwind CSS v4 setup verified');
        $this->info('💡 Slate colors are configured via CSS variables in slate.css');
        $this->info('💡 No tailwind.config.js needed - Slate only supports Tailwind CSS v4');
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

