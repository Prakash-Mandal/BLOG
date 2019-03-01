<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 21/2/19
 * Time: 4:57 PM
 */

namespace core;

use config\Database;
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
    protected $conn = null;

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
        $this->conn = $this->db->startConnection();

//        if($this->conn instanceof \PDOException) {
//            echo '<pre>' . $this->db . '</pre>';
//        }
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

        $this->db->stopConnection();

    }

    public function Database()

    {
        $query = 'INSERT INTO
              `Article`(
                `Article_Title`,
                `Article`,
                `User_Id`,
                `Created_Date`,
                `Modified_Date`
              )
            VALUES(
              :value0,
              :value1,
              :value2,
              CURRENT_TIMESTAMP,
              CURRENT_TIMESTAMP
            )';
        $params = [
            ':value0' => "Article Title",
            ':value1' => "This is a alticle which is saved from BLOG of MVC Architecture",
            ':value2' => '4'
        ];


        $result = $this->db->querySQL($query, $params);

        echo '<pre>';
        if (!($result instanceof \PDOException)) {
            echo "Result  :  ";
            var_dump($result);
        } else {
            echo "Error  :  " ;
            var_dump($result->errorInfo);

        }
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