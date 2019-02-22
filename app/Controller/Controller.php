<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 21/2/19
 * Time: 4:49 PM
 */

namespace controller;

use model\Model;
use view\Index;
use controller\ControllerInterface;

require_once 'ControllerInterface.php';

/**
 * Class Controller
 * @package controller
 */
class Controller implements ControllerInterface
{
    /**
     * @var string
     */
    protected $model = 'Model\Model';
    /**
     * @var string
     */
    protected $modelMethod = '_toString';
    /**
     * @var array
     */
    protected $param = [];
    /**
     * @var string
     */
    protected $view = 'View\Index';
    /**
     * @var string
     */
    protected $viewMethod = 'run';
    /**
     * @var array
     */
    protected $data = [];

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        echo "Controller Constructor<br>";
    }

    /**
     *
     */
    public function index()
    {
        // TODO: Implement index() method.
        $data = call_user_func_array([$this->model, $this->modelMethod],[$this->param]);
        array_push($this->data, $data);
        $this->view = new $this->view();
        call_user_func_array([$this->view, $this->viewMethod], [$this->data]);

    }

    /**
     * @param $model
     * @param $method
     * @param array $params
     */
    public function model($model, $method, $params = [])
    {
        // TODO: Implement model() method.

        if (file_exists('../Model/' . $model . '.php')) {
            require_once '../Model/' . $model . '.php';
            $this->model = new $model();
            if (method_exists($this->model, $method)) {
                $this->method = $method;
            }
        }

        $this->param = $params ? $params : [];

    }

    /**
     * @param $view
     * @param array $data
     */
    public function view($view, $data = [])
    {
        // TODO: Implement view() method.

        if (file_exists('../View/' . $view . '.php')) {
            require_once '../View/' . $view . '.php';
            $this->view = $view;
        }

        $this->data = $data ? $data : [];
    }

}