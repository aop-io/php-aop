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
 * Support `\Aop\JoinPoint\Support\FunctionSupportInterface`.
 * This trait provides a reflector for the `JoinPoint` classes of kind `function`.
 *
 * @see \Aop\JoinPoint\Support\FunctionSupportInterface
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
trait ReflectionFunctionTrait
{
    /**
     * @see \Aop\JoinPoint\Support\FunctionSupportInterface::createReflectionFunction()
     */
    public function createReflectionFunction()
    {
        return new \ReflectionFunction($this->getFunctionName());
    }

    /**
     * @see \Aop\JoinPoint\Support\FunctionSupportInterface::getReflectionFunction()
     */
    public function getReflectionFunction($singleton = true)
    {
        static $ref; // singleton

        if($singleton && $ref) {
            return $ref;
        }

        return $ref = $this->createReflectionFunction();
    }
}
