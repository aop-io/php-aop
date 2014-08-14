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
 * PointcutInterface provides the generic methods of pointcut created by the weaver
 * when an aspect is satisfied.
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
interface PointcutInterface
{
    /**
     * Constructor.
     *
     * @param string $selector The selector of pointcut,
     *                         e.g: `User->get*()`.
     *
     * @param string $pointcut The pointcut that triggered the join point,
     *                         e.g: `User->getUsername()`.
     *                         Note: `$selector` is not necessarily identical with the `$pointcut`.
     */
    public function __construct($selector, $pointcut = null);

    /**
     * Get the name of the pointcut
     *
     * @return string   The name of the pointcut. Namespaced with "dot" notation
     *                  and you can use the `snake_case` in the segments (eg: blog.last_comments).
     *                  If `null` the name is the selector + the object hash separated by a dot.
     *                  E.g: `User->get*().619a799747d348fa1caf181a72b65d9f`
     */
    public function getName();

    /**
     * Get the selector of pointcut.
     * Note: The selector is not necessarily identical with the pointcut.
     *
     * @return string The selector of pointcut.
     */
    public function getSelector();

    /**
     * Define the pointcut that triggered the join point.
     * Note: The selector is not necessarily identical with the pointcut.
     *
     * The pointcut is automatically defined by the interceptor during
     * the construction of join point.
     *
     * @param  string $pointcut The pointcut.
     *
     * @return \Aop\Pointcut\PointcutInterface Returns the current instance.
     */
    public function setPointcut($pointcut);

    /**
     * Get the pointcut that triggered the join point.
     * Note: The selector is not necessarily identical with the pointcut.
     *
     * @return null|string Returns `null` if the join point is not triggered,
     *                      the pointcut (string) if the join point is triggered.
     */
    public function getPointcut();

    /**
     * Returns a string representation of the current object.
     * Note: The selector is not necessarily identical with the pointcut.
     *
     * @return string The pointcut
     */
    public function __toString();
}
