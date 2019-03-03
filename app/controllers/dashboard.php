<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 2/3/19
 * Time: 1:40 PM
 */

namespace controller;


class Dashboard extends Controller
{

    function Index()
    {
        // TODO: Implement Index() method.
        echo $_SESSION['User_Id'];

        if (!isset($_SESSION['User_Id'])) {
            header('Location: /login');
        } else {
            header('Location: /article');
        }
    }

}

///getArticle/' . $_SESSION['User_Id']