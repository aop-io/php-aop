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
namespace Aop\Weaver;

use
    Aop\Advice\AdviceInterface,
    Aop\Pointcut\PointcutInterface,
    Aop\Exception\WeaverException
;

/**
 * Class Weaver
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
class Weaver implements WeaverInterface
{
    /**
     * The AOP interceptor used for weaving
     *
     * @var \Aop\Weaver\Interceptor
     */
    private static $interceptor;

    /**
     * Constructor.
     * To avoid unexpected errors, the weaver must be created once only.
     *
     * @param \Aop\Weaver\Interceptor $interceptor A PHP interceptor
     *
     * @throws \Aop\Exception\WeaverException
     */
    public function __construct(Interceptor $interceptor)
    {
        // if already loaded
        if (self::$interceptor) {
            throw new WeaverException(
                'You have a design error, the weaver is already loaded.
                To avoid unexpected errors, the weaver must be created once only.'
            );
        }

        self::$interceptor = $interceptor;
    }

    /**
     * Get the PHP interceptor.
     *
     * @return \Aop\Weaver\Interceptor An Interceptor instance
     */
    public function getInterceptor()
    {
        return self::$interceptor;
    }

    /**
     * @inheritdoc
     * @see \Aop\Weaver\WeaverInterface::isEnabled()
     */
    public function isEnabled($index = null, $selector = null)
    {
        return $this->getInterceptor()->isEnabled($index, $selector);
    }

    /**
     * @inheritdoc
     * @see \Aop\Weaver\WeaverInterface::enable()
     */
    public function enable($index = null, $selector = null)
    {
        return $this->getInterceptor()->enable($index, $selector);
    }

    /**
     * @inheritdoc
     * @see \Aop\Weaver\WeaverInterface::disable()
     */
    public function disable($index = null, $selector = null)
    {
        return $this->getInterceptor()->disable($index, $selector);
    }

    /**
     * @inheritdoc
     * @see \Aop\Weaver\WeaverInterface::getPointcut()
     */
    public function getPointcut($index)
    {
        return $this->getInterceptor()->getPointcut($index);
    }

    /**
     * @inheritdoc
     * @see \Aop\Weaver\WeaverInterface::getIndexOfSelector()
     */
    public function getIndexOfSelector($selector, $status = WeaverInterface::ENABLE)
    {
        return $this->getInterceptor()->getIndexOfSelector($selector, $status);
    }

    /**
     * @inheritdoc
     * @see \Aop\Weaver\WeaverInterface::getLastIndex()
     */
    public function getLastIndex()
    {
        return $this->getInterceptor()->getLastIndex();
    }

    /**
     * @inheritdoc
     * @see \Aop\Weaver\WeaverInterface::addBefore()
     */
    public function addBefore(PointcutInterface $pointcut, AdviceInterface $advice,
                              array $options = []
    ) {
        return $this->getInterceptor()->addBefore($pointcut, $advice, $options);
    }

    /**
     * @inheritdoc
     * @see \Aop\Weaver\WeaverInterface::addAround()
     */
    public function addAround(PointcutInterface $pointcut, AdviceInterface $advice,
                              array $options = [])
    {
        return $this->getInterceptor()->addAround($pointcut, $advice, $options);
    }

    /**
     * @inheritdoc
     * @see \Aop\Weaver\WeaverInterface::addAfter()
     */
    public function addAfter(PointcutInterface $pointcut, AdviceInterface $advice,
                             array $options = [])
    {
        return $this->getInterceptor()->addAfter($pointcut, $advice, $options);
    }

    /**
     * @inheritdoc
     * @see \Aop\Weaver\WeaverInterface::addAfterThrow()
     */
    public function addAfterThrow(PointcutInterface $pointcut, AdviceInterface $advice,
                                  array $options = [])
    {
        return $this->getInterceptor()->addAfterThrow($pointcut, $advice, $options);
    }

    /**
     * @inheritdoc
     * @see \Aop\Weaver\WeaverInterface::addAfterReturn()
     */
    public function addAfterReturn(PointcutInterface $pointcut, AdviceInterface $advice,
                                   array $options = [])
    {
        return $this->getInterceptor()->addAfterReturn($pointcut, $advice, $options);
    }
}
