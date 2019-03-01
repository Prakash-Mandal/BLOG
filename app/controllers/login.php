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

            header('Location: /?');

        }

    }

    public function emptyData()
    {

    }

    /*
     * http://localhost/login/validating
     */
    function validating () {

        // Loads /models/User.php
        $this->model('User');

        $result = $this->model->validateUser();


        if (1 === count($result)) { // User->validateUser() from /models/User.php

            $_SESSION["name"] = $this->model->getFirstName() . ' ' . $this->model->getLastName() ;
            $_SESSION['User_Id'] = $this->model->getUserId();
            $_SESSION['email'] = $this->model->getEmailId();

            header('Location: /article');

        } else {

            $data ='Error... No such Data';
            $this->view('template/HeaderView');
            echo `<div class="alert alert-danger" role="alert">
                    Alert : $data
                </div>`;
            $this->view('SignUpView');
            $this->view('template/FooterView');


        }



    }

    /*
     * http://localhost/login/logout
     */
    function logout () {

        $_SESSION = [];
        session_unset();
        header('Location: /');

    }

}
