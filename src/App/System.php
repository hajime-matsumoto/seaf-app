<?php
/**
 * Seaf: Simple Easy Acceptable micro-framework.
 *
 * クラスを定義する
 *
 * @author HAjime MATSUMOTO <mail@hazime.org>
 * @copyright Copyright (c) 2014, Seaf
 * @license   MIT, http://seaf.hazime.org
 */

namespace Seaf\App

use Seaf;
use Seaf\Core\Environment\Environment;

/**
 * System
 */
class App
{
    /**
     */
    private $environment;
    /**
     * @var bool
     */
    private $fake_exit = false;

    public function __construct ( )
    {
        $this->init( );
    }

    public function init ( )
    {
        $this->environment = new Environment();
        $this->environment->addComponentNamespace( __NAMESPACE__ . '//Component' );
    }

    public function __call ( $name, $params )
    {
        $this->environment->call( $name, $params );
    }
}

/* vim: set expandtab ts=4 sw=4 sts=4: et*/
