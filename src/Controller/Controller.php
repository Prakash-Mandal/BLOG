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

//include_once './ControllerInterface.php';


interface ControllerInterface
{
    public static function index();
    public function model($model, $method, $params = []);
    public function view($view, $data = []);

}

/**
 * Class Controller
 * @package controller
 */
class Controller implements ControllerInterface
{
    /**
     * @var string
     */
    protected $model = 'Model';
    /**
     * @var string
     */
    protected $method = '_toString';
    /**
     * @var string
     */
    protected $view = 'index';
    /**
     * @var array
     */
    protected $param = [];
    /**
     * @var array
     */
    protected $data = [];

    /**
     * Controller constructor.
     */
    public function __construct()
    {

        $this->model = new $this->model;
    }

    public static function index()
    {
        // TODO: Implement index() method.
    }

    /**
     * @param $model
     * @param $method
     * @param array $params
     */
    public function model($model, $method, $params = [])
    {
        // TODO: Implement model() method.
    }

    /**
     * @param $view
     * @param array $data
     */
    public function view($view, $data = [])
    {
        // TODO: Implement view() method.
    }

}