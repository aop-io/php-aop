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
namespace Aop\JoinPoint\Support;

/**
 * JoinPointSupportInterceptorInterface provides all the methods that an interceptor
 * must override for the abstraction of JoinPoint instances.
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
interface JoinPointSupportInterceptorInterface extends
    ArgsGetterSupportInterface,
    ArgsSetterSupportInterface,
    ClassSupportInterface,
    ExceptionGetterSupportInterface,
    FunctionSupportInterface,
    KindSupportInterface,
    MethodSupportInterface,
    PointcutSupportInterface,
    ProceedSupportInterface,
    PropertySupportInterface,
    PropertyValueGetterSupportInterface,
    PropertyValueSetterSupportInterface,
    ReturnValueGetterSupportInterface,
    ReturnValueSetterSupportInterface
{
    /**
     * Constructor.
     *
     * @param mixed $patch Specific "patch" argument provided by the interceptor.
     */
    public function __construct(&$patch);

    /**
     * Get the current patch performed by the interceptor.
     * The patch is a join point performed by the interceptor.
     *
     * @returns mixed The current patch.
     */
    public function getPatch();
}
