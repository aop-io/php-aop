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
namespace Aop\JoinPoint\Traits;

/**
 * Support `\Aop\JoinPoint\Support\PropertySupportInterface`.
 * This trait provides a reflector for the `JoinPoint` classes of kind `property`.
 *
 * @see \Aop\JoinPoint\Support\PropertySupportInterface
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
trait ReflectionPropertyTrait
{
    /**
     * @see \Aop\JoinPoint\Support\PropertySupportInterface::createReflectionProperty()
     */
    public function createReflectionProperty()
    {
        return new \ReflectionProperty($this->getClassName(), $this->getPropertyName());
    }

    /**
     * @see \Aop\JoinPoint\Support\PropertySupportInterface::getReflectionProperty()
     */
    public function getReflectionProperty($singleton = true)
    {
        static $ref; // singleton

        if($singleton && $ref) {
            return $ref;
        }

        return $ref = $this->createReflectionProperty();
    }
}
