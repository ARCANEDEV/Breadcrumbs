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
    protected $vendor  = 'arcanedev';

    /**
     * Package name.
     *
     * @var string
     */
    protected $package = 'breadcrumbs';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer   = true;

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

        // Publishes
        $this->publishConfig();
        $this->publishViews();
    }

    /**
     * Get the services provided by the provider
     *
     * @return array
     */
    public function provides()
    {
        return [
            'arcanedev.breadcrumbs',
            Contracts\Breadcrumbs::class,
        ];
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
        $this->app->singleton('arcanedev.breadcrumbs', function ($app) {
            /** @var  \Illuminate\Contracts\Config\Repository  $config */
            $config = $app['config'];

            return new Breadcrumbs(
                $config->get('breadcrumbs.template.supported', []),
                $config->get('breadcrumbs.template.default', '')
            );
        });

        $this->app->bind(Contracts\Breadcrumbs::class, 'arcanedev.breadcrumbs');
    }
}
