<?php

declare(strict_types=1);

namespace Arcanedev\Breadcrumbs\Tests\Stubs\Controllers;

use Arcanedev\Breadcrumbs\HasBreadcrumbs;
use Illuminate\Routing\Controller;

/**
 * Class     DummyController
 *
 * @package  Arcanedev\Breadcrumbs\Tests\Stubs
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DummyController extends Controller
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasBreadcrumbs;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct()
    {
        $this->registerBreadcrumbs('public');
    }

    /* -----------------------------------------------------------------
     |  Controller Methods
     | -----------------------------------------------------------------
     */

    public function aboutUs()
    {
        $this->addBreadcrumbRoute('About', 'public::about');
        $this->addBreadcrumb('ARCANEDEV');
        $this->loadBreadcrumbs();

        return 'ARCANEDEV page';
    }
}
