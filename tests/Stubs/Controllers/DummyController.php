<?php namespace Arcanedev\Breadcrumbs\Tests\Stubs\Controllers;

use Arcanedev\Breadcrumbs\HasBreadcrumbs;
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

    use HasBreadcrumbs;

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
