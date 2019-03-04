<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 25/2/19
 * Time: 4:57 PM
 */

namespace controller;

class Signup extends Controller
{
    private $first_name = '';
    private $last_name = '';
    private $email = '';
    private $pass = '';

    public function Index()
    {
        // TODO: Implement Index() method.


    }

    public function setData()
    {
        $this->first_name = $_POST["first_name"];
        $this->last_name = $_POST["last_name"];
        $this->email = $_POST["email"];
        $this->pass = $_POST["pass"];

        $this->addData();
    }

    private function addData()
    {
        $this->model('User');
        if ($this->model->addUser()) {
            $data =["alert-info", "User Added Succesfully ...   Login to Continue" , '/' , ''];
            $this->view('template/HeaderView');
            $this->view('template/Alert', $data);
            $this->view('SignUpView');
            $this->view('template/FooterView');
        } else {
            $data =["alert-info", 'Cannot Add the User' , '/' , ''];
            $this->view('template/HeaderView', $data);
            $this->view('SignUpView');
            $this->view('template/FooterView');
        }

    }

    public function emptyData($data = "")
    {

    }

}