# AOP for PHP

Implements a simplified subset of AOP (Aspect Oriented Programming) pragmatism and provides the AOP features for PHP application.

Only one dependency, the _code interceptor_.

The PHP lib of AOP.io provides an abstraction layer easy to use for AOP development, so it can work with several PHP code interceptors.

The first interceptor implemented uses [PECL AOP-PHP extension](https://github.com/aop-io/pecl-aop-interceptor).

Other interceptors are planned.
If you want to create an interceptor, I can help you (email me) :smiley:


## Getting Started

### Install

1) Install an interceptor, e.g: [PECL AOP-PHP extension](https://github.com/aop-io/pecl-aop-interceptor).

2) Download [PHP AOP.io lib](https://github.com/aop-io/php-aop/archive/master.zip) (and configure your autoloader) or use composer `require: "aop-io/php-aop"`.


### Usage

```php
use Aop\Aop;

// Init
$aop = new Aop();

function hello($name)
{
    return $name
}

// Interception of kind 'around'
$aop->addAround('hello()', function($joinPoint) {

    // In this context,
    // $joinPoint is an instance of \Aop\JoinPoint\AroundFunctionJoinPoint

    // get an array with all arguments values
    var_dump($joinPoint->getArgs()); // (array) 0 => World !

    // change the return value
    $joinPoint->setReturnValue('Hello Nico !');

    // Proceed the execution of the function ( hello() )
    $joinPoint->proceed();
});

echo hello('World !'); // Hello Nico !
```

You can use statically:

```php
use Aop\Aop;

// Init
new Aop();

Aop::addAround('hello()', function($jp) {

    // change the return value
    $jp->setReturnValue('Hello Nico !');

    // Proceed the execution of the function
    $jp->proceed();
});

echo hello('World !'); // Hello Nico !
```

  > The documentation is in progress ...


## License

[MIT](https://github.com/aop-io/php-aop/blob/master/LICENSE) (c) 2013, Nicolas Tallefourtane.


## Author

| [![Nicolas Tallefourtane - Nicolab.net](http://www.gravatar.com/avatar/d7dd0f4769f3aa48a3ecb308f0b457fc?s=64)](http://nicolab.net) |
|---|
| [Nicolas Talle](http://nicolab.net) |
| [![Make a donation via Paypal](https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=PGRH4ZXP36GUC) |