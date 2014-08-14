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
namespace Aop\Pointcut;

/**
 * Create a pointcut.
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
class Pointcut implements PointcutInterface
{
    /**
     * Pointcut selector.
     * E.g: User->get*()
     * @var string
     */
    protected $selector;

    /**
     * Pointcut
     * @var string
     */
    protected $pointcut;

    /**
     * Name of the pointcut.
     * @var string
     */
    protected $name;

    /**
     * @inheritdoc
     * @see \Aop\Pointcut\PointcutInterface::__construct()
     */
    public function __construct($selector, $pointcut = null, $name = null)
    {
        $this->selector = $selector;
        $this->pointcut = $pointcut;

        if(null === $name) {
            $name = $selector.'.'.spl_object_hash($this);
        }

        $this->name = $name;
    }

    /**
     * @inheritdoc
     * @see \Aop\Pointcut\PointcutInterface::getName()
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     * @see \Aop\Pointcut\PointcutInterface::getSelector()
     */
    public function getSelector()
    {
        return $this->selector;
    }

    /**
     * @inheritdoc
     * @see \Aop\Pointcut\PointcutInterface::getPointcut()
     */
    public function getPointcut()
    {
        return $this->pointcut;
    }

    /**
     * @inheritdoc
     * @see \Aop\Pointcut\PointcutInterface::setPointcut()
     */
    public function setPointcut($pointcut)
    {
        $this->pointcut = $pointcut;

        return $this;
    }

    /**
     * @inheritdoc
     * @see \Aop\Pointcut\PointcutInterface::__toString()
     */
    public function __toString()
    {
        return $this->pointcut;
    }
}
