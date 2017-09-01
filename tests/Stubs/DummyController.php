<?php namespace Arcanedev\Breadcrumbs\Tests\Stubs;

use Arcanedev\Breadcrumbs\Traits\BreadcrumbsTrait;
use Arcanedev\Support\Http\Controller;

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

    use BreadcrumbsTrait;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct()
    {
        parent::__construct();

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
