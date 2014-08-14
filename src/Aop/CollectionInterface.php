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
 * Interface Collection
 *
 * @inheritdoc
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
interface CollectionInterface extends \ArrayAccess
{
    /**
     * Get the name of the current Collection
     *
     * @return string The name, using "dot" notation for each segments of the namespace
     */
    public function getName();

    /**
     * Get all items names handled by the current collection
     *
     * @return array An array of names
     */
    public function getNames();

    /**
     * Get all items.
     *
     * @return array
     */
    public function all();

    /**
     * Get an iterator.
     *
     * @return \ArrayIterator
     */
    public function getIterator();

    /**
     * Add an item.
     *
     * @param  object     $item
     *
     * @return \Aop\CollectionInterface The current instance
     *  that implements `\Aop\CollectionInterface`.
     */
    public function add($item);

    /**
     * Get an item by reference.
     *
     * @param  string $name The item name.
     * @return object The item (by reference).
     */
    public function &get($name);

    /**
     * Remove an item of the collection.
     *
     * @param string $name The name of item to remove.
     */
    public function remove($name);
}
