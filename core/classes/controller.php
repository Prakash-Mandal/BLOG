<?php

namespace controller;

abstract class Controller {

    private $route = [];

    private $args = 0;

    private $params = [];

    protected $model;

    protected $view;

    protected $db;

    function __construct ($db) {

        $this->db = $db;

        $this->route = explode('/', URI);

        $this->args = count($this->route);

        $this->router();

    }

    private function router () {

        if (class_exists('controller\\' . $this->route[1])) {

            if (3 >= $this->args) {
                $method = explode('?', $this->route[$this->args - 1]);
                $this->route[2] = $method[0];
            }

            if ($this->args >= 3) {
                if (method_exists($this, $this->route[2])) {
                    $this->uriCaller(2, 3);
                } else {
                    $this->uriCaller(0, 2);
                }
            } else {
                $this->uriCaller(0, 2);
            }

        } else {

            if ($this->args >= 2) {
                if (method_exists($this, $this->route[1])) {
                    $this->uriCaller(1, 2);
                } else {
                    $this->uriCaller(0, 1);
                }
            } else {
                $this->uriCaller(0, 1);
            }

        }

    }

    private function uriCaller ($method, $param) {

        for ($i = $param; $i < $this->args; $i++) {
            $this->params[$i] = $this->route[$i];
        }

        if ($method == 0)
            call_user_func_array(array($this, 'Index'), $this->params);
        else {
            call_user_func_array(array($this, $this->route[$method]), $this->params);

        }

    }

    abstract function Index ();

    function model ($path) {


        $class = explode('/', $path);
        $class = $class[count($class)-1];
//        $path = strtolower($path);

        if(file_exists(ROOT . 'app/models/' . $path . '.php')) {
            $class = '\models\\' . $class;
            require(ROOT . 'app/models/' . $path . '.php');
            $this->model = new $class();
        } else {
            echo "No such Model";
            return null;
        }

    }

    function view ($path, $data = []) {

        if (is_array($data))
            extract($data);

//        var_dump($data);

        require(ROOT . 'app/views/' . $path . '.html');

    }

}
