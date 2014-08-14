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
 * `\Aop\KindConstantInterface::KIND_BEFORE`.
 *
 * @see \Aop\KindConstantInterface::KIND_BEFORE
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
abstract class BeforeJoinPoint extends JoinPoint
{

}
