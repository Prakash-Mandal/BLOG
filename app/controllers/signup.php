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
        echo "Data Added";
//        die();
        $this->model('User');
        if ($this->model->addUser()) {

        } else {
            $data =['Cannot Add the User'];
            $this->view('template/HeaderView', $data);
//            $this->view('template/Modal', $data);
            $this->view('SignUpView');
            $this->view('template/FooterView');
        }

    }

    public function emptyData($data = "")
    {

    }

}