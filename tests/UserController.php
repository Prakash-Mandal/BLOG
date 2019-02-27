<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 21/2/19
 * Time: 5:03 PM
 */

namespace controller;

use model\User;

/**
 * Class UserController
 * @package controller
 */
class UserController extends Controller
{
    protected $user;

    private $database;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        echo "Controller UserConstructor<br>";
        $this->user = new User();
    }

    public function login($user_mail = '', $password = '')
    {

        if ($this->user->login($user_mail, $password)) {
            $this->view = 'Dashboard';
        } else {
            $this->view = 'index';
        }

    }
}