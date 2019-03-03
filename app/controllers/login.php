<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 24/2/19
 * Time: 8:30 PM
 */

namespace controller;

class Login extends Controller {

    /*
     * http://localhost/login
     */
    function Index() {

        if (!isset($_SESSION['login'])) {

            $this->view('template/HeaderView');
            $this->view('SignUpView');
            $this->view('template/FooterView');
        } else {

            header('Location: /dashboard');
        }
    }

    /*
     * http://localhost/login/validating
     */
    protected function validating () {

        // Loads /models/User.php
        $this->model('User');

        $result = $this->model->validateUser();


        if ($result) { // User->validateUser() from /models/User.php

            header('Location: /dashboard');
        } else {

            $data =['alert-danger', 'Error... No such Data ' . $result, '', 'hidden'];
            $this->view('template/HeaderView');
            $this->view('template/Alert', $data);
            $this->view('SignUpView');
            $this->view('template/FooterView');
        }
    }

    /*
     * http://localhost/login/logout
     */
    protected function logout () {

        $_SESSION = [];
        session_unset();
        header('Location: /');
    }
}
