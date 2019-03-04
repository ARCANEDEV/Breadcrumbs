<?php namespace Arcanedev\Breadcrumbs;

use Arcanedev\Breadcrumbs\Contracts\Breadcrumbs as BreadcrumbsContract;
use Closure;
use Illuminate\Support\HtmlString;

/**
 * Class     Breadcrumbs
 *
 * @package  Arcanedev\Breadcrumbs
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Breadcrumbs implements BreadcrumbsContract
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const DEFAULT_TEMPLATE = 'bootstrap-4';

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Default template view.
     *
     * @var string
     */
    private $template;

    /**
     * Supported template views.
     *
     * @var array
     */
    protected $supported = [
        'bootstrap-4' => 'breadcrumbs::bootstrap-4',
    ];

    /** @var array */
    protected $callbacks = [];

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Create a Breadcrumbs instance.
     *
     * @param  array        $supported
     * @param  string|null  $template
     */
    public function __construct(array $supported, $template = null)
    {
        $this->setSupported($supported);
        $this->setTemplate($template ?: self::DEFAULT_TEMPLATE);
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the supported template.
     *
     * @param  array  $supported
     *
     * @return self
     */
    public function setSupported(array $supported)
    {
        $this->supported = $supported;

        return $this;
    }

    /**
     * Set default template view.
     *
     * @param  string  $template
     *
     * @return self
     */
    public function setTemplate($template)
    {
        $this->checkTemplate($template);

        $this->template = $template;

        return $this;
    }

    /**
     * Get the template view.
     *
     * @return string
     */
    private function getView()
    {
        return $this->supported[$this->template];
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register a breadcrumb domain.
     *
     * @param  string    $name
     * @param  \Closure  $callback
     *
     * @return self
     */
    public function register($name, Closure $callback)
    {
        $this->checkCallbackName($name);

        $this->callbacks[$name] = $callback;

        return $this;
    }

    /**
     * Render breadcrumbs items.
     *
     * @param  string|null  $name
     * @param  array        $params
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function render($name = null, ...$params)
    {
        return new HtmlString(
            view($this->getView(), [
                'breadcrumbs' => $this->generate($name, $params)
            ])->render()
        );
    }

    /**
     * Generate the breadcrumbs.
     *
     * @param  string  $name
     * @param  array   $params
     *
     * @return array
     */
    public function generate($name, ...$params)
    {
        return (new Builder($this->callbacks))
            ->call($name, $params)
            ->toArray();
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check Template.
     *
     * @param  string  $template
     *
     * @throws Exceptions\InvalidTemplateException
     * @throws Exceptions\InvalidTypeException
     */
    private function checkTemplate($template)
    {
        if ( ! is_string($template)) {
            $type = gettype($template);
            throw new Exceptions\InvalidTypeException(
                "The default template name must be a string, $type given."
            );
        }

        $template = strtolower(trim($template));

        if ( ! array_key_exists($template, $this->supported)) {
            throw new Exceptions\InvalidTemplateException(
                "The template [$template] is not supported."
            );
        }
    }

    /**
     * Check Name.
     *
     * @param  string  $name
     *
     * @throws Exceptions\InvalidTypeException
     */
    private function checkCallbackName(&$name)
    {
        if ( ! is_string($name)) {
            $type = gettype($name);

            throw new Exceptions\InvalidTypeException(
                "The callback name value must be a string, $type given."
            );
        }

        $name = strtolower(trim($name));
    }
}
