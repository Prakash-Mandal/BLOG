<?php

namespace controller;

abstract class Controller {

    private $route = [];

    private $args = 0;

    private $params = [];

    protected $model;

    protected $view;

    function __construct () {

        $this->route = explode('/', URI);

        $this->args = count($this->route);

        $this->getController();

    }

    protected function getController() {

        if (class_exists('controller\\' . $this->route[1])) {

            if (3 >= $this->args) {
                $method = explode('?', $this->route[$this->args - 1]);
                $this->route[2] = $method[0];
            }

            if ($this->args >= 3) {
                if (method_exists($this, $this->route[2])) {
                    $this->functionCaller(2, 3);
                } else {
                    $this->functionCaller(0, 2);
                }
            } else {
                $this->functionCaller(0, 2);
            }

        } else {

            if ($this->args >= 2) {
                if (method_exists($this, $this->route[1])) {
                    $this->functionCaller(1, 2);
                } else {
                    $this->functionCaller(0, 1);
                }
            } else {
                $this->functionCaller(0, 1);
            }

        }

    }

    protected function functionCaller ($method, $parameterCount) {

        for ($i = $parameterCount; $i < $this->args; $i++) {
            $this->params[$i] = $this->route[$i];
        }

        if ($method == 0) {
            call_user_func_array(array($this, 'Index'), $this->params);
        }
        else
            call_user_func_array(array($this, $this->route[$method]), $this->params);

    }

    abstract function Index ();

    protected function model ($path) {


        $class = explode('/', $path);
        $class = $class[count($class)-1];

        if(file_exists(ROOT . 'app/models/' . $path . '.php')) {
            $class = '\models\\' . $class;
            require(ROOT . 'app/models/' . $path . '.php');
            $this->model = new $class();
        } else {
            echo "No such Model";
            return null;
        }

    }

    protected function view ($path, $data = []) {

        if (is_array($data))
            extract($data);

        require(ROOT . 'app/views/' . $path . '.html');

    }

    protected function __toString()
    {
        // TODO: Implement __toString() method.
        return "Controller is " . get_called_class();
    }

}
