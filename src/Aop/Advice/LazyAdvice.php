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
namespace Aop\Advice;

use
    Aop,
    Aop\JoinPoint\JoinPoint,
    Aop\Exception\KindException,
    Aop\Traits\OptionTrait
;

/**
 * AdviceInterface lazy proxy.
 *
 * @inheritdoc
 *
 * `LazyAdvice` is useful to create on the fly an advice (`AdviceInterface`) from a `callable`.
 * The `callable` can be all that is compatible with `call_user_func()`
 * (Closure, function, class method (static and object), ...).
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
class LazyAdvice implements AdviceInterface
{
    use OptionTrait;

    /**
     * Kind of advice.
     *
     * @see AdviceInterface::getKind()
     * @see \Aop\KindConstantInterface
     * @var int
     */
    protected $kind;

    /**
     * The callable that will be executed when the advice is invoked.
     * @var callable
     */
    protected $callable;

    /**
     * Name of the advice.
     * @var string
     */
    protected $name;

    /**
     * Advice constructor.
     *
     * @param callable    $callable The callable that will be executed when the advice is invoked.
     *                              The `$callable` can be all that is compatible with
     *                              `call_user_func()` (Closure, function,
     *                              class method (static and object), ...).
     *                              A `JoinPoint` instance is passed to the `$callable`,
     *                              the kind of `JoinPoint` depends on the context of the aspect.
     *
     * @param array       $options
     *
     * @param int|null    $kind     Kind of advice.
     *                              `null` (by default) if the advice is generic
     *                              or not have a dependency related to the context.
     *
     * @param string|null           Name of the advice. If `null` the name is the object hash.
     *
     * @throws \Aop\Exception\KindException
     */
    public function __construct(callable $callable, array $options = [], $kind = null,  $name = null)
    {
        if(null !== $kind and !Aop::isValidKind($kind)) {
            throw new KindException('The kind is invalid.');
        }

        if(null === $name) {
            $name = spl_object_hash($this);
        }

        $this->callable = $callable;


        // Eventually provided by \Aop\Traits\OptionTrait
        $this->options  = $options;

        $this->kind     = $kind;
        $this->name     = $name;
    }

    /**
     * @inheritdoc
     * @see \Aop\Advice\AdviceInterface::__invoke()
     */
    public function __invoke(JoinPoint $jp)
    {
        return call_user_func($this->callable, $jp, $this->options);
    }

    /**
     * @inheritdoc
     * @see \Aop\Advice\AdviceInterface::getKind()
     */
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * @inheritdoc
     * @see \Aop\Advice\AdviceInterface::getName()
     */
    public function getName()
    {
        return $this->name;
    }
}
