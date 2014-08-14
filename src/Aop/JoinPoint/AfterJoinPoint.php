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

namespace Aop\JoinPoint;

/**
 * Base class for all `JoinPoint` abstraction layers of kind
 * `\Aop\KindConstantInterface::KIND_AFTER`.
 *
 * @see \Aop\KindConstantInterface::KIND_AFTER
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
abstract class AfterJoinPoint extends JoinPoint
{

}
