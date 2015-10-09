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
    public function index()
    {
        return 'Home page';
    }

    public function about()
    {
        $this->addBreadcrumb('About us', 'about-us');

        return 'Home page';
    }
}
