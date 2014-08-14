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
 * This interface is useful to import constants of "kind" (Class::KIND_*).
 * It's also useful to know if a class contains these constants.
 * <code>
 *      if($obj instanceof KindConstantInterface) {
 *          // ...
 *      }
 * </code>
 *
 * @see \Aop\Aop::getKinds()
 * @see \Aop\Aop::getKindName()
 * @see \Aop\Aop::isValidKind()
 * @see \Aop\Aop::isKindBefore()
 * @see \Aop\Aop::isKindAround()
 * @see \Aop\Aop::isKindAfter()
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
interface KindConstantInterface
{
    /**
     * An PHP Exception thrown
     *
     * @var int
     */
    const KIND_THROW                 = 4;

    /**
     * Function call (not a method call).
     *
     * @var int
     */
    const KIND_FUNCTION              = 8;

    /**
     * Method call (method of object).
     *
     * @var int
     */
    const KIND_METHOD                = 16;

    /**
     * Property (read or write).
     *
     * @var int
     */
    const KIND_PROPERTY              = 32;

    /**
     * Read (an access).
     *
     * @var int
     */
    const KIND_READ                  = 1;

    /**
     * Write.
     *
     * @var int
     */
    const KIND_WRITE                 = 2;

    /**
     * Before a given call.
     * May it be function, method or property access (read / write).
     *
     * @var int
     */
    const KIND_BEFORE                = 200;

    /**
     * Before a function call (not a method call).
     *
     * @var int
     */
    const KIND_BEFORE_FUNCTION       = 208;

    /**
     * Before a method call (method of an object).
     *
     * @var int
     */
    const KIND_BEFORE_METHOD         = 216;

    /**
     * Before a property (read / write).
     *
     * @var int
     */
    const KIND_BEFORE_PROPERTY       = 232;

    /**
     * Before a property access (read only).
     *
     * @var int
     */
    const KIND_BEFORE_PROPERTY_READ  = 233;

    /**
     * Before a property write (write only).
     *
     * @var int
     */
    const KIND_BEFORE_PROPERTY_WRITE = 234;

    /**
     * Around a given call.
     * May it be function, method or property access (read / write).
     *
     * @var int
     */
    const KIND_AROUND                = 400;

    /**
     * Around a function call (not a method call).
     *
     * @var int
     */
    const KIND_AROUND_FUNCTION       = 408;

    /**
     * Around a method call (method of an object).
     *
     * @var int
     */
    const KIND_AROUND_METHOD         = 416;

    /**
     * Around a property (read / write).
     *
     * @var int
     */
    const KIND_AROUND_PROPERTY       = 432;

    /**
     * Around a property access (read only).
     *
     * @var int
     */
    const KIND_AROUND_PROPERTY_READ  = 433;

    /**
     * Around a property write (write only).
     *
     * @var int
     */
    const KIND_AROUND_PROPERTY_WRITE = 434;

    /**
     * After a given call.
     * May it be function, method or property access (read / write).
     *
     * @var int
     */
    const KIND_AFTER                 = 800;

    /**
     * After throwing in a given call.
     * May it be function or method.
     *
     * KIND_AFTER + KIND_THROW
     *
     * @var int
     */
    const KIND_AFTER_THROW           = 804;

    /**
     * After return of a given call.
     * May it be function or method.
     *
     * KIND_AFTER + KIND_READ
     *
     * @var int
     */
    const KIND_AFTER_RETURN          = 801;

    /**
     *  After a function call (not a method call).
     *
     *  @var int
     */
    const KIND_AFTER_FUNCTION        = 808;

    /**
     * After a function call (not a method call) throwing a PHP Exception.
     *
     * KIND_AFTER_FUNCTION + KIND_AFTER_THROW
     *
     *  @var int
     */
    const KIND_AFTER_FUNCTION_THROW  = 1612;

    /**
     * After a function call (not a method call) returning the value.
     *
     * KIND_AFTER_FUNCTION + KIND_AFTER_RETURN
     *
     * @var int
     */
    const KIND_AFTER_FUNCTION_RETURN = 1609;

    /**
     * After a method call (method of an object).
     *
     * @var int
     */
    const KIND_AFTER_METHOD          = 816;

    /**
     * After a method call (method of an object) throwing a PHP Exception.
     *
     * KIND_AFTER_METHOD + KIND_AFTER_THROW
     *
     * @var int
     */
    const KIND_AFTER_METHOD_THROW    = 1620;

    /**
     * After a method call (method of an object) returning the value.
     *
     * KIND_AFTER_METHOD + KIND_AFTER_RETURN
     *
     * @var int
     */
    const KIND_AFTER_METHOD_RETURN   = 1617;

    /**
     * After a property (read / write).
     *
     * @var int
     */
    const KIND_AFTER_PROPERTY        = 832;

    /**
     * After a property access (read only).
     *
     * @var int
     */
    const KIND_AFTER_PROPERTY_READ   = 833;

    /**
     * After a property write (write only).
     *
     * @var int
     */
    const KIND_AFTER_PROPERTY_WRITE  = 834;
}
