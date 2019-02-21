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
    protected $controller ='Controller';

    protected $method = 'index';

    protected $params = [];

    public function __construct()
    {
        $this->run();

    }

    public function run()
    {
        echo '<pre>';

        $data = new Database();

//        call_user_func_array([$this->controller,$this->method], [$this->params]);

    }



}