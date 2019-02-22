<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 21/2/19
 * Time: 4:57 PM
 */

namespace core;

use config\Database;

class Blog
{
    protected $controller = 'Controller';

    protected $method = 'index';

    protected $params = [];

    protected $db = null;

    public function __construct()
    {
        define("URI", $_SERVER['REQUEST_URI']);
        define("ROOT", $_SERVER['DOCUMENT_ROOT']);
        $this->call();
//        $this->run();

    }

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

    function require($path) {

        require ROOT . $path;

    }

    function config()
    {
        $this->require('/core/config/Database.php');
        try {
            $this->db = new Database();
            $this->db->querySQL('SET NAMES utf8',[]);
            $this->db->querySQL('SET CHARACTER_SET utf8_unicode_ci',[]);
            $this->db->startConnection();
        } catch (\PDOException $pdoe) {
            echo 'Error : ' . $pdoe->getMessage();
        }
    }

    public function call()
    {
        $url = $this->parseURL();
        echo "Url : ";
        var_dump($url);
        echo '<br>';

        if (isset($url[0])) {
            if (file_exists('../src/Controller/' . $url[0] . '.php')) {
                echo $this->controller;
                $this->controller = $url[0];
                unset($url[0]);
            }
        }

        include_once ROOT.'/app/Controller/' . $this->controller . '.php';
        $controller = 'controller\\' . $this->controller;
        $this->controller = new $controller;

        if (isset($url[1])) {
            echo $url[1];
            if (method_exists($this->controller, $url[1])) {
                echo $url[1];
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];
        var_dump($this->params);
        echo 'END';

        call_user_func_array([$this->controller, $this->method], [$this->parseURL()]);

    }

    public function run()
    {
        echo $_SERVER['REQUEST_URI'];
        var_dump($this->parseURL());
        $data = new Database();
        $query = "select * from Blog_User";
        $params = [];

        $stmt = $data->querySQL($query, $params);

        call_user_func_array([$this->controller,$this->method], [$this->params]);
    }

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



}