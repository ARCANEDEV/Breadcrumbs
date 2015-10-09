<?php namespace Arcanedev\Breadcrumbs\Tests\Stubs;

use Arcanedev\Breadcrumbs\Traits\BreadcrumbsTrait;
use Arcanedev\Support\Bases\Controller;

/**
 * Class     DummyController
 *
 * @package  Arcanedev\Breadcrumbs\Tests\Stubs
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DummyController extends Controller
{
    /* ------------------------------------------------------------------------------------------------
     |  Traits
     | ------------------------------------------------------------------------------------------------
     */
    use BreadcrumbsTrait;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    public function __construct()
    {
        parent::__construct();

        $this->registerBreadcrumbs('public');
    }

    /* ------------------------------------------------------------------------------------------------
     |  Controller Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function aboutUs()
    {
        $this->addBreadcrumbRoute('About', 'public::about');
        $this->addBreadcrumb('ARCANEDEV');
        $this->loadBreadcrumbs();

        return 'ARCANEDEV page';
    }
}
