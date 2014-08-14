<?php
/*
 * This file is part of the `aop-io/php-aop` package.
 *
 * (c) Nicolas Tallefourtane <dev@nicolab.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code or visit http://aop.io
 *
 * @copyright Nicolas Tallefourtane <http://nicolab.net>
 */
namespace Aop\Traits;

/**
 * Add options accessor.
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
trait OptionTrait
{
    /**
     * Options
     * @var array
     */
    protected $options = array();

    /**
     * Get all options.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Checks if an option exists.
     *
     * @param  string $name
     * @return bool
     */
    public function hasOption($name)
    {
        return array_key_exists($name, $this->options);
    }

    /**
     * Get an option
     *
     * @param  string $name
     * @return mixed
     */
    public function getOption($name)
    {
        return $this->options[$name];
    }

    /**
     * Set an option value
     *
     * @param  string $name
     * @return object The current instance
     */
    public function setOption($name, $value)
    {
        $this->options[$name] = $value;

        return $this;
    }

    /**
     * Add options.
     *
     * @param  array $options An array of options
     *                        [(string) <option name> => (mixed)<option value>, ...].
     *
     * @return object The current instance
     */
    public function addOptions(array $options)
    {
        foreach ($options as $name => $value) {
            $this->options[$name] = $value;
        }

        return $this;
    }
}
