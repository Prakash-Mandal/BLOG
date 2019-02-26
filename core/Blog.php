<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 21/2/19
 * Time: 4:57 PM
 */

namespace core;

use config\Database;
use Main;
use models;

/**
 * Class Blog
 * @package core
 */
class Blog
{
    protected $controller;

    /**
     * @var null
     */
    protected $db = null;

    /**
     * @var array
     */
    private $config = [];

    /**
     * Blog constructor.
     */
    public function __construct()
    {
        define("URI", $_SERVER['REQUEST_URI']);
        define("ROOT", $_SERVER['DOCUMENT_ROOT']);
    }

    /**
     *
     */
    function autoload () {

        spl_autoload_register(function ($class) {

            $class = strtolower($class);
            if (file_exists(ROOT . '/core/classes/' . $class . '.php')) {

                require_once ROOT . '/core/classes/' . $class . '.php';

            } else if (file_exists(ROOT . '/core/helpers/' . $class . '.php')) {

                require_once ROOT . '/core/helpers/' . $class . '.php';

            }

        });

    }

    /**
     * @param $path
     */
    function requireFile($path) {

        require_once ROOT . $path;

    }

    /**
     *
     */
    function config()
    {
        $this->requireFile('core/config/session.php');

        $this->db = new Database();
        $this->db->startConnection();

    }
    function addJS()
    {
        echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="./public/Javascript/blog.js"></script>
        <noscript>Script not running</noscript>';
    }

    /**
     *
     */
    public function call()
    {

        session_name($this->config['sessionName']);
        session_start();

        $route = explode('/', URI);

        if (file_exists(ROOT . 'app/controllers/' . $route[1] . '.php')) {
            $this->requireFile('app/controllers/' . $route[1] . '.php');
            $this->controller = '\controller\\' . ucfirst($route[1]);
            $this->controller = new $this->controller($this->db);
//            echo $this->controller;
        } else {
            $this->requireFile('app/controllers/main.php');
            $this->controller = new \controller\Main($this->db);
        }

    }

    public function Database()
    {
        $query = 'Select * from Blog_User where `Email_Id` = :value0';
        $param = [":value0" => "Pmandal4444@gmail.com"];

        $result = $this->db->querySQL($query, $param);

        var_dump($result);

    }

    /**
     * @return array
     */
    public function parseURL()
    {
        $str = $_SERVER['REQUEST_URI'];
        if (!empty($str) && '/' !== $str) {
            return explode('/',
                filter_var(trim($str,
                    '/'),
                    FILTER_SANITIZE_URL
                )
            );
        } else {
            return [];
        }
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->controller->__toString();
    }

}