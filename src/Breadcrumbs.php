<?php namespace Arcanedev\Breadcrumbs;

use Arcanedev\Breadcrumbs\Contracts\BreadcrumbsContract;
use Arcanedev\Breadcrumbs\Exceptions\InvalidTemplateException;
use Arcanedev\Breadcrumbs\Exceptions\InvalidTypeException;

class Breadcrumbs implements BreadcrumbsContract
{
    /* ------------------------------------------------------------------------------------------------
     |  Constants
     | ------------------------------------------------------------------------------------------------
     */
    const DEFAULT_TEMPLATE = 'bootstrap-3';

    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var array */
    protected $callbacks = [];

    /** @var string */
    private $template;

    /** @var array */
    private $views = [
        'bootstrap-3' => 'breadcrumbs::bootstrap-3',
    ];

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    public function __construct($config = [])
    {
        if ( ! isset($config['template'])) {
            $config['template'] = self::DEFAULT_TEMPLATE;
        }

        $this->setTemplate($config['template']);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set template
     *
     * @param  string $template
     *
     * @return Breadcrumbs
     */
    private function setTemplate($template)
    {
        $this->checkTemplate($template);

        $this->template = $template;

        return $this;
    }

    /**
     * Get the template view
     *
     * @return string
     */
    private function getView()
    {
        return $this->views[$this->template];
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register a domain
     *
     * @param  string   $name
     * @param  callable $callback
     *
     * @return Breadcrumbs
     */
    public function register($name, callable $callback)
    {
        $this->checkName($name);

        $this->callbacks[$name] = $callback;

        return $this;
    }

    /**
     * Generate the breadcrumbs
     *
     * @param  string $name
     *
     * @return array
     */
    public function generate($name)
    {
        return $this->generateArray(
            $name,
            array_slice(func_get_args(), 1)
        );
    }

    /**
     * Generate array
     *
     * @param  string $name
     * @param  array  $args
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
     * Render breadcrumbs
     *
     * @param  string $name
     *
     * @return string
     */
    public function render($name = null)
    {
        return $this->renderArray(
            $name,
            array_slice(func_get_args(), 1)
        );
    }

    /**
     * Render breadcrumbs from array
     *
     * @param  string $name
     * @param  array $args
     *
     * @return string
     */
    public function renderArray($name, $args = [])
    {
        return view($this->getView(), $this->generateArray($name, $args));
    }

    /* ------------------------------------------------------------------------------------------------
     |  Check functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check Template
     *
     * @param  string $template
     *
     * @throws InvalidTemplateException
     * @throws InvalidTypeException
     */
    private function checkTemplate($template)
    {
        if ( ! is_string($template)) {
            throw new InvalidTypeException(
                'The template value must be a string, ' . gettype($template) . ' given'
            );
        }

        $template = strtolower(trim($template));

        if ( ! array_key_exists($template, $this->views)) {
            throw new InvalidTemplateException(
                'The template [' . $template . '] is not supported.'
            );
        }
    }

    /**
     * Check Name
     *
     * @param  string $name
     *
     * @throws InvalidTypeException
     */
    private function checkName(&$name)
    {
        if ( ! is_string($name)) {
            throw new InvalidTypeException(
                'The name value must be a string, ' . gettype($name) . ' given'
            );
        }

        $name = strtolower(trim($name));
    }
}
