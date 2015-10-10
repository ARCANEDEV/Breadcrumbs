<?php namespace Arcanedev\Breadcrumbs;

use Arcanedev\Breadcrumbs\Contracts\BreadcrumbsInterface;
use Closure;

/**
 * Class     Breadcrumbs
 *
 * @package  Arcanedev\Breadcrumbs
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Breadcrumbs implements BreadcrumbsInterface
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
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
    private $supported = [
        'bootstrap-3' => 'breadcrumbs::bootstrap-3',
    ];

    /** @var array */
    protected $callbacks = [];

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Create a Breadcrumbs instance.
     *
     * @param  array   $supported
     * @param  string  $template
     */
    public function __construct(array $supported, $template = '')
    {
        $this->supported = $supported;

        if ( ! empty($template)) {
            $template = 'bootstrap-3';
        }

        $this->setTemplate($template);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
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

    /* ------------------------------------------------------------------------------------------------
     |  Main functions
     | ------------------------------------------------------------------------------------------------
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
     *
     * @return string
     */
    public function render($name = null)
    {
        $breadcrumbs = $this->generateArray(
            $name, array_slice(func_get_args(), 1)
        );

        return (string) view($this->getView(), compact('breadcrumbs'))->render();
    }

    /**
     * Generate the breadcrumbs.
     *
     * @param  string  $name
     *
     * @return array
     */
    public function generate($name)
    {
        return $this->generateArray(
            $name, array_slice(func_get_args(), 1)
        );
    }

    /**
     * Generate array.
     *
     * @param  string  $name
     * @param  array   $args
     *
     * @return array
     */
    private function generateArray($name, array $args = [])
    {
        $generator = new Builder($this->callbacks);

        return $generator->call($name, $args)->toArray();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Check functions
     | ------------------------------------------------------------------------------------------------
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
