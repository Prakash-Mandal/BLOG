<?php

namespace core;

use models;

/**
 * Class Blog
 * @package core
 */
class Blog

{
    protected $controller;

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
    function includingClassesAndHelpers () {

        spl_autoload_register(function ($class) {

            $class = strtolower($class);
            if (file_exists(ROOT . '/core/classes/' . $class . '.php')) {

                require_once ROOT . '/core/classes/' . $class . '.php';

            } elseif (file_exists(ROOT . '/core/helpers/' . $class . '.php')) {

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

    }

    /**
     *
     */
    public function call()
    {

        session_name($this->config['sessionName']);
        session_start();

        $route = explode('/', URI);

        if (isset($_SESSION['User_Id'])) {
            if (file_exists(ROOT . 'app/controllers/' . $route[1] . '.php')) {

                $this->requireFile('app/controllers/' . $route[1] . '.php');
                $this->controller = '\controller\\' . ucfirst($route[1]);
                $this->controller = new $this->controller();
            } else {
                header('Location: /dashboard');
            }

        } else {
            if ("login" === $route[1] || "signup" === $route[1] ) {
                $this->requireFile('app/controllers/' . $route[1] . '.php');
                $this->controller = '\controller\\' . ucfirst($route[1]);
                $this->controller = new $this->controller();
            } else {

                $this->requireFile('app/controllers/main.php');
                $this->controller = new \controller\Main();
            }
        }

    }

    public function Database()
    {
        $article = new models\Article();
        $result = $article->getArticle();
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
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 21/2/19
 * Time: 4:57 PM
 */