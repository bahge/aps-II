<?php


namespace aps\appcore;

use aps\controller\Login;

if(!isset($_SESSION)) {session_start () ; }

trait Auth
{
    /**
     * @return bool
     */
    static public function isAuth():bool
    {
        if( isset($_SESSION['username']) ) {
            return true;
        }
        return false;
    }

    static public function isAdmin():bool
    {
        if( $_SESSION['level'] == 1 ) {
            return true;
        }
        return false;
    }

    static public function isAuthHeader():void
    {
        if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
            $login = new Login();
            $r = $login->getLoginHeaderData ($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);
        }
    }
}