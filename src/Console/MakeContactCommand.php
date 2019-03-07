<?php

namespace Sanjeevlabs\Contact\Console;

use Illuminate\Console\Command;
use Illuminate\Console\DetectsApplicationNamespace;

class MakeContactCommand extends Command
{
    use DetectsApplicationNamespace;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:contact
                    {--views : Publish contact us views}
                    {--force : Overwrite existing views by default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate contact us form views and routes';

    /**
     * The views that need to be exported.
     *
     * @var array
     */
    protected $views = [
        'contact/contact.stub' => 'contact/contact.blade.php',
        'contact/layout.stub' => 'contact/layout.blade.php',
        'emails/contact/contact.stub' => 'emails/contact/contact.blade.php',
        'emails/contact/contact-confirm.stub' => 'emails/contact/contact-confirm.blade.php',
    ];

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->createDirectories();

        $this->exportViews();

        if (! $this->option('views')) {
            file_put_contents(
                app_path('Http/Controllers/ContactController.php'),
                $this->compileControllerStub()
            );

            file_put_contents(
                base_path('routes/web.php'),
                file_get_contents(__DIR__.'/stubs/make/routes.stub'),
                FILE_APPEND
            );
        }

        $this->info('Contact files generated successfully.');
    }

    /**
     * Create the directories for the files.
     *
     * @return void
     */
    protected function createDirectories()
    {
        if (! is_dir(resource_path('views/contact'))) {
            mkdir(resource_path('views/contact'), 0755, true);
        }

        if (! is_dir(resource_path('views/emails/contact'))) {
            mkdir(resource_path('views/emails/contact'), 0755, true);
        }
    }

    /**
     * Export the contact views.
     *
     * @return void
     */
    protected function exportViews()
    {
        foreach ($this->views as $key => $value) {
            if (file_exists(resource_path('views/'.$value)) && ! $this->option('force')) {
                if (! $this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
                    continue;
                }
            }

            copy(
                __DIR__.'/stubs/make/views/'.$key,
                resource_path('views/'.$value)
            );
        }

    }

    /**
     * Compiles the ContactController stub.
     *
     * @return string
     */
    protected function compileControllerStub()
    {
        return str_replace(
            '{{namespace}}',
            $this->getAppNamespace(),
            file_get_contents(__DIR__.'/stubs/make/controllers/ContactController.stub')
        );
    }
}
