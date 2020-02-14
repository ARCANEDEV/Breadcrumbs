<?php

declare(strict_types=1);

namespace Arcanedev\Breadcrumbs\Entities;

use Illuminate\Support\{Arr, Fluent};

/**
 * Class     BreadcrumbItem
 *
 * @package  Arcanedev\Breadcrumbs\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  string  title
 * @property  string  url
 * @property  bool    first
 * @property  bool    last
 */
class BreadcrumbItem extends Fluent
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Create a breadcrumb item instance.
     *
     * @param  array|object  $attributes
     */
    public function __construct(array $attributes = [])
    {
        $keys = ['title', 'url', 'icon'];

        parent::__construct(Arr::only($attributes, $keys) + [
            'extra' => Arr::except($attributes, $keys)
        ]);

        $this->resetPosition();
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the title.
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->get('title');
    }

    /**
     * Get the url.
     *
     * @return string|null
     */
    public function getUrl()
    {
        return $this->get('url');
    }

    /**
     * Set as first item.
     *
     * @return $this
     */
    public function setFirst()
    {
        $this->attributes['first'] = true;

        return $this;
    }

    /**
     * Set as last item.
     *
     * @return $this
     */
    public function setLast()
    {
        $this->attributes['last'] = true;

        return $this;
    }

    /**
     * Get the extra attribute.
     *
     * @param  string  $key
     * @param  mixed   $default
     *
     * @return mixed
     */
    public function extra($key, $default = null)
    {
        return Arr::get($this->attributes['extra'], $key, $default);
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make a breadcrumb item instance.
     *
     * @param  string  $title
     * @param  string  $url
     * @param  array   $data
     *
     * @return $this
     */
    public static function make($title, $url, array $data = [])
    {
        return new self($data + compact('title', 'url'));
    }

    /**
     * Reset position.
     *
     * @return $this
     */
    public function resetPosition()
    {
        $this->attributes['first'] = false;
        $this->attributes['last']  = false;

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check is first item.
     *
     * @return bool
     */
    public function isFirst(): bool
    {
        return $this->get('first', false);
    }

    /**
     * Check is last item.
     *
     * @return bool
     */
    public function isLast(): bool
    {
        return $this->get('last', false);
    }
}
