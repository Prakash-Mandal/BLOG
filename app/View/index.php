<?php

namespace view;

class Index
{
    public function __construct($data)
    {
        require_once '../View/HeaderView.php';

        require_once '../View/' . $data . '.php';

        require_once '../View/FooterView.php';
    }

    public function run($data = [])
    {
        echo $data;
    }
}
