<?php

namespace Sanjeevlabs\Contact;

use Illuminate\Support\ServiceProvider;
use Sanjeevlabs\Contact\Console\MakeContactCommand;

class ContactServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/contact.php' => config_path('contact.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/contact.php', 'contact');

        $this->app->bind('command.make:contact', MakeContactCommand::class);

        $this->commands([
            'command.make:contact'
        ]);
    }

}
