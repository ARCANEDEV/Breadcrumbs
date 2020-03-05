<?php

declare(strict_types=1);

namespace Arcanedev\Breadcrumbs;

use Arcanedev\Breadcrumbs\Contracts\Breadcrumbs as BreadcrumbsContract;
use Arcanedev\Support\Providers\PackageServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

/**
 * Class     BreadcrumbsServiceProvider
 *
 * @package  Arcanedev\Breadcrumbs
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class BreadcrumbsServiceProvider extends PackageServiceProvider implements DeferrableProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Package name.
     *
     * @var string
     */
    protected $package = 'breadcrumbs';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        parent::register();

        $this->registerConfig();

        // Register the Breadcrumbs service.
        $this->singleton(BreadcrumbsContract::class, function ($app) {
            return new Breadcrumbs(
                $app['config']->get('breadcrumbs.template.supported', []),
                $app['config']->get('breadcrumbs.template.default', '')
            );
        });
    }

    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        $this->loadTranslations();
        $this->loadViews();

        if ($this->app->runningInConsole()) {
            $this->publishConfig();
            $this->publishTranslations();
            $this->publishViews();
        }
    }

    /**
     * Get the services provided by the provider
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            BreadcrumbsContract::class,
        ];
    }
}
