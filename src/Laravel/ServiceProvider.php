<?php namespace Arcanedev\Breadcrumbs\Laravel;

use Arcanedev\Breadcrumbs\Breadcrumbs;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
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
        $basePath  = __DIR__ . '/../..';
        $viewsPath = $basePath . '/resources/views';

        $this->loadViewsFrom($viewsPath, 'breadcrumbs');
        $this->publishes([
            $viewsPath => base_path('resources/views/arcanedev/breadcrumbs'),
        ]);

        $this->mergeConfigFrom(
            $basePath . '/config/config.php', 'breadcrumbs'
        );

        $this->registerServices();
        $this->registerFacades();
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
    private function registerServices()
    {
        $this->app->singleton('arcanedev.breadcrumbs', function () {
            return new Breadcrumbs(config('breadcrumbs::config'));
        });
    }

    private function registerFacades()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Breadcrumbs', 'Arcanedev\Breadcrumbs\Laravel\Facade');
    }
}
