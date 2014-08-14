<?php
/*
 * This file is part of the `aop-io/php-aop` package.
 *
 * (c) Nicolas Tallefourtane <dev@nicolab.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code or visit http://aop.io
 *
 * @copyright Nicolas Tallefourtane http://nicolab.net
 */

// Rules for php-cs-fixer

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->in(__DIR__.'/src')
;

return Symfony\CS\Config\Config::create()
    ->fixers(array(
        'indentation',
        'linefeed',
        'trailing_spaces',
        'unused_use',
        'visibility',
        'php_closing_tag',
        'braces',
        'extra_empty_lines',
        'eof_ending',
        'function_declaration',
        'controls_spaces',
        'psr0',
        'elseif',
        'phpdoc_params',
    ))
    ->finder($finder)
;