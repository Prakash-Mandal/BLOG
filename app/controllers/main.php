<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 24/2/19
 * Time: 8:57 PM
 */

namespace controller;

class Main extends Controller {

    /*
     * http://localhost/
     */
    function Index () {

        if (!isset($_SESSION['login'])) {

            header('Location: /login');

        } else {

            header('Location: /dashboard');

        }

    }

    /*
     * http://localhost/anothermainpage
     */
    function anotherMainPage () {
        echo 'Works!';
    }

}

