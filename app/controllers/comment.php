<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 28/2/19
 * Time: 2:58 PM
 */

namespace controller;


class Comment extends Controller
{
    public function Index()
    {
        // TODO: Implement Index() method.

        if (isset($_SESSION['User_Id'])) {

            header("Location: /article/getArticle");

        } else {

            header('Location: /login');

        }
    }

    function addComment()
    {
        $this->model('Comment');
        $result = $this->model->addComment();

        if ($result instanceof \PDOException) {
           $message = $result->errorInfo;
           $data = [
               "alert-info",
               $message[2],
               "", "hidden"
           ];
           $this->view('Alert', $data);
        } else {
            $this->Index();
        }
    }

    function deleteComment()
    {
        $this->model('Comment');
        $result = $this->model->deleteComment();

    }

}