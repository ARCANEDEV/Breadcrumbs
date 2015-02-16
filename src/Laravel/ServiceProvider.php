<?php namespace Arcanedev\Breadcrumbs\Laravel;

use Arcanedev\Breadcrumbs\Breadcrumbs;

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
     * Bootstrap the application events
     */
    public function boot()
    {
        parent::boot();

        $this->package('arcanedev/breadcrumbs', null, __DIR__);
    }

    /**
     * Register the service provider
     */
    public function register()
    {
        $this->app->bindShared('arcanedev.breadcrumbs', function($app) {
            $config = $app['config']->get('breadcrumbs::config');

            return new Breadcrumbs($config);
        });
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
