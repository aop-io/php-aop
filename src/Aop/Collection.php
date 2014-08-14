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
namespace Aop;

/**
 * Class Collection that implements CollectionInterface.
 *
 * @inheritdoc
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
abstract class Collection extends \ArrayObject implements CollectionInterface
{
    /**
     * Container
     * @var array
     */
    protected $container = [];

    /**
     * @inheritdoc
     * @see \Aop\CollectionInterface::getName()
     */
    public function getName()
    {
        return 'default';
    }

    /**
     * @inheritdoc
     * @see \Aop\CollectionInterface::getNames()
     */
    public function getNames()
    {
        return array_keys($this->container);
    }

    /**
     * @inheritdoc
     * @see \Aop\CollectionInterface::all()
     */
    public function all()
    {
        return $this->container;
    }

    /**
     * @inheritdoc
     * @see \ArrayObject::getIterator()
     */
    public function getIterator()
    {
        return new \ArrayIterator($this);
    }

    /**
     * @inheritdoc
     * @see \Aop\CollectionInterface::add()
     */
    public function add($item)
    {
        $this->container[$item->getName()] = $item;

        return $this;
    }

    /**
     * @inheritdoc
     * @see \Aop\CollectionInterface::get()
     */
    public function &get($name)
    {
        return $this->container[$name];
    }

    /**
     * @inheritdoc
     * @see \Aop\CollectionInterface::remove()
     */
    public function remove($name)
    {
        return $this->offsetUnset($name);
    }

    /**
     * @inheritdoc
     * @see \ArrayObject::offsetGet()
     */
    public function offsetGet($name)
    {
        return isset($this->container[$name]) ? $this->container[$name] : null;
    }

    /**
     * @inheritdoc
     * @see \ArrayAccess::offsetSet()
     */
    public function offsetSet($name, $value)
    {
        if (null === $name) {
            $this->container[] = $value;
        } else {
            $this->container[$name] = $value;
        }

        return $this;
    }

    /**
     * @inheritdoc
     * @see \ArrayAccess::offsetExists()
     */
    public function offsetExists($name)
    {
        return isset($this->container[$name]);
    }

    /**
     * @inheritdoc
     * @see \ArrayAccess::offsetUnset()
     */
    public function offsetUnset($name)
    {
        unset($this->container[$name]);

        return $this;
    }
}
