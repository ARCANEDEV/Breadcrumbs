<?php namespace Arcanedev\Breadcrumbs\Laravel;

use Arcanedev\Breadcrumbs\Breadcrumbs;
use Illuminate\Foundation\AliasLoader;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the service provider
     */
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'breadcrumbs');

        $this->publishes([
            __DIR__ . '/views' => base_path('resources/views/arcanedev/breadcrumbs'),
        ]);

        $this->mergeConfigFrom(
            __DIR__ . '/config/config.php', 'breadcrumbs'
        );

        $this->app->singleton('arcanedev.breadcrumbs', function($app) {
            $config = $app['config']->get('breadcrumbs::config');

            return new Breadcrumbs($config);
        });

        $loader = AliasLoader::getInstance();
        $loader->alias('Breadcrumbs', 'Arcanedev\Breadcrumbs\Laravel\Facade');
    }

    /**
     * Get the services provided by the provider
     *
     * @return array
     */
    public function provides()
    {
        return [
            'arcanedev.breadcrumbs'
        ];
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
}
