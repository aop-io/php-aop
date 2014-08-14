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
 * Support `\Aop\JoinPoint\Support\ClassSupportInterface`.
 * This trait provides a reflector for the `JoinPoint` classes of kind `method` and kind `property`.
 *
 * @see \Aop\JoinPoint\Support\ClassSupportInterface
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
trait ReflectionClassTrait
{
    /**
     * @see \Aop\JoinPoint\Support\ClassSupportInterface::createReflectionClass()
     */
    public function createReflectionClass()
    {
        if($obj = $this->getObject()) {
            return new \ReflectionClass($obj);
        }

        return new \ReflectionClass($this->getClassName());
    }

    /**
     * @see \Aop\JoinPoint\Support\ClassSupportInterface::getReflectionClass()
     */
    public function getReflectionClass($singleton = true)
    {
        static $ref; // singleton

        if($singleton && $ref) {
            return $ref;
        }

        return $ref = $this->createReflectionClass();
    }
}
