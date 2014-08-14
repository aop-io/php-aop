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
namespace Aop\Aspect;

use Aop\Traits\OptionTrait;

/**
 * AspectInterface lazy proxy.
 *
 * @inheritdoc
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
class LazyAspect implements AspectInterface
{
    use OptionTrait;

    /**
     * Name of the aspect.
     * @var string
     */
    protected $name;

    /**
     * Constructor.
     *
     * @param string $name    Aspect name.
     * @param array  $options Aspect options [(string) <option name> => (mixed)<option value>, ...]
     */
    public function __construct($name = null, array $options = [])
    {
        if(null === $name) {
            $name = spl_object_hash($this);
        }

        $this->name    = $name;
        $this->options = $options; // provided by OptionTrait
    }

    /**
     * @inheritdoc
     * @see AspectInterface::getName()
     */
    public function getName()
    {
        return $this->name;
    }
}
