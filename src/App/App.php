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

namespace Seaf\App;

use Seaf;
use Seaf\Core\Environment\Environment;
use Seaf\App\Component\Request\Request;

/**
 * APP
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
        $this->environment->addComponentNamespace( __NAMESPACE__ . '\\Component' );

        $this->bind( $this, array(
            'run' => '_run'
        ));
    }

    /**
     * アプリケーションを実行する
     */
    public function _run ( Request $req = null )
    {
        $router = $this->router( );
        $req    = $req == null ? $this->request( ): $req;

        $status = 1;
        while ( $route = $router->route( $req ) ) {

            $status = 0;

            $result = $route->invoke( );

            if( $result !== true ) break;

            $router->next( );
        }

        if( $status > 0 ) {
            die( "STATUS:".$status );
        }

        return $result;
    }

    public function __call ( $name, $params )
    {
        return $this->environment->call( $name, $params );
    }
}

/* vim: set expandtab ts=4 sw=4 sts=4: et*/
