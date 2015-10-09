<?php namespace Arcanedev\Breadcrumbs;

use Arcanedev\Breadcrumbs\Contracts\BreadcrumbsInterface;
use Closure;

/**
 * Class     Breadcrumbs
 *
 * @package  Arcanedev\Breadcrumbs
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @todo:     Complete the doc comments
 */
class Breadcrumbs implements BreadcrumbsInterface
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var string */
    private $template;

    /** @var array */
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
     * Set template.
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
        $this->checkName($name);

        $this->callbacks[$name] = $callback;

        return $this;
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
    public function generateArray($name, array $args = [])
    {
        $generator = new Builder($this->callbacks);
        $generator->call($name, $args);

        return $generator->toArray();
    }

    /**
     * Render breadcrumbs.
     *
     * @param  string  $name
     *
     * @return string
     */
    public function render($name = null)
    {
        return $this->renderArray(
            $name, array_slice(func_get_args(), 1)
        );
    }

    /**
     * Render breadcrumbs from array.
     *
     * @param  string  $name
     * @param  array   $args
     *
     * @return string
     */
    public function renderArray($name, $args = [])
    {
        $breadcrumbs = $this->generateArray($name, $args);

        return view($this->getView(), compact('breadcrumbs'))->render();
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
    private function checkName(&$name)
    {
        if ( ! is_string($name)) {
            throw new Exceptions\InvalidTypeException(
                'The name value must be a string, ' . gettype($name) . ' given'
            );
        }

        $name = strtolower(trim($name));
    }
}
