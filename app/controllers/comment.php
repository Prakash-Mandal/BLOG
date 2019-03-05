<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 28/2/19
 * Time: 2:58 PM
 */

namespace controller;


/**
 * Class Comment
 * @package controller
 */
class Comment extends Controller
{
    /**
     *Index function for redirection
     */
    public function Index()
    {
        // TODO: Implement Index() method.
        $url = "";

        if (isset($_SESSION['User_Id'])) {

            $url = "Location: /article/showArticle/" . $_POST["articleId"] ;

        } else {

            $url = 'Location: /login';
        }
        header($url);
    }

    /**
     * To get the comments on the Article
     * @param $articleId
     */
    function showComment($articleId)
    {
        $this->model('Comment');
        $limit = 2;
        $this->model->getComments($articleId,$limit);

    }

    /**
     *
     */
    function addComment()
    {
        $this->model('Comment');
        $this->model->addComment();

        $this->Index();

    }

    /**
     *
     */
    function deleteComment()
    {
        $this->model('Comment');
        $result = $this->model->deleteComment();

    }

}