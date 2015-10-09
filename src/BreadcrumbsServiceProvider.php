<?php namespace Arcanedev\Breadcrumbs;

use Arcanedev\Support\PackageServiceProvider as ServiceProvider;

/**
 * Class     BreadcrumbsServiceProvider
 *
 * @package  Arcanedev\Breadcrumbs
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class BreadcrumbsServiceProvider extends ServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Vendor name.
     *
     * @var string
     */
    protected $vendor       = 'arcanedev';

    /**
     * Package name.
     *
     * @var string
     */
    protected $package      = 'breadcrumbs';

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the base path of the package.
     *
     * @return string
     */
    public function getBasePath()
    {
        return dirname(__DIR__);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerConfig();
        $this->registerBreadcrumbsService();
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        parent::boot();

        $this->registerViews();
    }

    /**
     * Get the services provided by the provider
     *
     * @return array
     */
    public function provides()
    {
        return ['arcanedev.breadcrumbs'];
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the Breadcrumbs service.
     */
    private function registerBreadcrumbsService()
    {
        $this->singleton('arcanedev.breadcrumbs', function ($app) {
            /** @var  \Illuminate\Config\Repository  $config */
            $config = $app['config'];

            return new Breadcrumbs(
                $config->get('breadcrumbs')
            );
        });
    }

    /**
     * Register the package views.
     */
    private function registerViews()
    {
        $viewsPath = $this->getBasePath() . '/resources/views';
        $this->loadViewsFrom($viewsPath, 'breadcrumbs');
        $this->publishes([
            $viewsPath => base_path('resources/views/vendor/breadcrumbs'),
        ]);
    }
}
