<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 21/2/19
 * Time: 4:50 PM
 */

namespace controller;

interface ControllerInterface
{
    public function index();
    public function model($model, $method, $params = []);
    public function view($view, $data = []);

}