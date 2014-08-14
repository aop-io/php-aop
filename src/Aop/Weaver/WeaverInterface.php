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
    Aop\KindConstantInterface,
    Aop\Advice\AdviceInterface,
    Aop\Pointcut\PointcutInterface
;

/**
 * Interface WeaverInterface
 * @inheritdoc
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
interface WeaverInterface extends KindConstantInterface
{
    /**
     * Running status: Weaving enabled
     *
     * @var int
     */
    const ENABLE  = 1;

    /**
     * Running status: Weaving disabled
     *
     * @var int
     */
    const DISABLE = 0;

    /**
     * Check if the weaver or an advice or a point cut is enabled.
     *
     * If the `$selector` is `null` and the `$index` is `null` also,
     * this method check if the AOP (global status) is enabled.
     *
     * @param  int|null     $index      The index of the advice to check,
     *                                  `null` (by default) to check all advices triggered
     *                                  by the `$selector` (if provided).
     *
     * @param  string|null $selector    The selector of point cut to check
     *                                  or `null` (by default) to check all (or by `$index`
     *                                  if provided).
     *
     * @return bool|null    * `true` if there is a `true` value,
     *                      * `false` if not a `true` value,
     *                      * `null` if is not defined.
     */
    public function isEnabled($index = null, $selector = null);

    /**
     * Enable AOP or an advice or a pointcut
     *
     * @param int|null|array $index The index of the advice to enable (reactive),
     *                              `null` (by default) to enable (reactive) all advices triggered
     *                              by the `$selector` (if provided).
     *
     * @param string|null $selector The point cut selector disabled to reactive
     *                              or `null` (by default) to enable by `$index`
     *                              or all (reactivate AOP if is disabled).
     */
    public function enable($index = null, $selector = null);

    /**
     * Disable AOP or an advice or a point cut.
     *
     * @param int|null|array $index     The index of the advice to disable,
     *                                  `null` (by default) to disable all advice triggered
     *                                  by the `$selector` (if provided).
     *
     * @param string|null $selector     The selector to disable
     *                                  or `null` (by default) to disable all.
     */
    public function disable($index = null, $selector = null);

    /**
     * Get the pointcut of an advice.
     *
     * @param  int               $index         The index of the advice
     * @return \Aop\Pointcut\PointcutInterfac   The pointcut of the advice.
     */
    public function getPointcut($index);

    /**
     * Get all index of advice that are triggered by a given `$selector`.
     *
     * @param  string $selector The selector to get all index of advice.
     *
     * @param  int    $status   Find the index with the status defined here (enable or disable),
     *                          `null` to get all (enabled and disabled).
     *
     * @return array  An array of index or an empty array if no index was found.
     */
    public function getIndexOfSelector($selector, $status = WeaverInterface::ENABLE);

    /**
     * Get the last index assigned to an advice.
     *
     * Important: The first index assigned is the integer `1`,
     * if no index was assigned then `null` is returned.
     *
     * @return int The last index assigned.
     */
    public function getLastIndex();

    /**
     * Add an advice of kind `before`.
     *
     * @see \Aop\KindConstantInterface::KIND_BEFORE
     * @see \Aop\Pointcut\PointcutInterface
     * @see \Aop\Advice\AdviceInterface
     *
     * @param \Aop\Pointcut\PointcutInterface $pointcut
     *  The pointcut instance that triggers the join point.
     *
     * @param \Aop\Advice\AdviceInterface $advice
     *  An advice instance invoked by the weaver to handle the join point.
     *
     * @param array $options
     *  An array of options:
     *    * 'weaver' => (array) <options for the weaver>
     *    * 'advice' => (array) <options for the advice>
     *
     * @return int  Returns the unique index number assigned
     *              to the current advice added in the weaver.
     */
    public function addBefore(PointcutInterface $pointcut, AdviceInterface $advice,
                              array $options = []);

    /**
     * Add an advice of kind `around`.
     *
     * @see \Aop\KindConstantInterface::KIND_AROUND
     * @see \Aop\Pointcut\PointcutInterface
     * @see \Aop\Advice\AdviceInterface
     *
     * @param \Aop\Pointcut\PointcutInterface $pointcut
     *  The pointcut instance that triggers the join point.
     *
     * @param \Aop\Advice\AdviceInterfaceAdviceInterface $advice
     *  An advice instance invoked by the weaver to handle the join point.
     *
     * @param array $options
     *  An array of options:
     *    * 'weaver' => (array) <options for the weaver>
     *    * 'advice' => (array) <options for the advice>
     *
     * @return int  Returns the unique index number assigned
     *              to the current advice added in the weaver.
     */
    public function addAround(PointcutInterface $pointcut, AdviceInterface $advice,
                              array $options = []);

    /**
     * Add an advice of kind `after`, also known as `final` in the AOP pragmatism.
     *
     * @see \Aop\KindConstantInterface::KIND_AFTER
     * @see \Aop\Pointcut\PointcutInterface
     * @see \Aop\Advice\AdviceInterface
     *
     * @param \Aop\Pointcut\PointcutInterface $pointcut
     *  The pointcut instance that triggers the join point.
     *
     * @param \Aop\Advice\AdviceInterface $advice
     *  An advice instance invoked by the weaver to handle the join point.
     *
     * @param array $options
     *  An array of options:
     *    * 'weaver' => (array) <options for the weaver>
     *    * 'advice' => (array) <options for the advice>
     *
     * @return int  Returns the unique index number assigned
     *              to the current advice added in the weaver.
     */
    public function addAfter(PointcutInterface $pointcut, AdviceInterface $advice,
                             array $options = []);

    /**
     * Add an advice of kind `after_throw` (uncaught) PHP Exception.
     *
     * @see \Aop\KindConstantInterface::KIND_AFTER_THROW
     * @see \Aop\Pointcut\PointcutInterface
     * @see \Aop\Advice\AdviceInterface
     *
     * @param \Aop\Pointcut\PointcutInterface $pointcut
     *  The pointcut instance that triggers the join point.
     *
     * @param \Aop\Advice\AdviceInterface $advice
     *  An advice instance invoked by the weaver to handle the join point.
     *
     * @param array $options
     *  An array of options:
     *    * 'weaver' => (array) <options for the weaver>
     *    * 'advice' => (array) <options for the advice>
     *
     * @return int  Returns the unique index number assigned
     *              to the current advice added in the weaver.
     */
    public function addAfterThrow(PointcutInterface $pointcut, AdviceInterface $advice,
                                  array $options = []);

    /**
     * Add an advice of kind `after_return` (no PHP Exception).
     *
     * @see \Aop\KindConstantInterface::KIND_AFTER_RETURN
     * @see \Aop\Pointcut\PointcutInterface
     * @see \Aop\Advice\AdviceInterface
     *
     * @param \Aop\Pointcut\PointcutInterface $pointcut
     *  The pointcut instance that triggers the join point.
     *
     * @param \Aop\Advice\AdviceInterface $advice
     *  An advice instance invoked by the weaver to handle the join point.
     *
     * @param array $options
     *  An array of options:
     *    * 'weaver' => (array) <options for the weaver>
     *    * 'advice' => (array) <options for the advice>
     *
     * @return int  Returns the unique index number assigned
     *              to the current advice added in the weaver.
     */
    public function addAfterReturn(PointcutInterface $pointcut, AdviceInterface $advice,
                                   array $options = []);
}
