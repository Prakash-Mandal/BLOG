<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 26/2/19
 * Time: 6:46 PM
 */

namespace controller;

use models\User;

class Article extends Controller
{

    public function Index()
    {
        // TODO: Implement Index() method.
        echo 'Article';

        if (isset($_SESSION['User_Id'])) {

            header("Location: /article/getArticle");

        } else {

            header('Location: /login');

        }

    }

    function showArticle($articleId = 1)
    {

        $this->model('Article');
        $blog = $this->model->getOneBlog($articleId);

        $this->view('template/HeaderView');

        if ($blog instanceof \PDOException) {

            echo '<div class="jumbotron ">';
            $message = $blog->errorInfo;
            $data = ["alert-info", $message[2], '/article/getArticle'];
            $this->view('template/Alert', $data);
            echo '</div>';

        } else {
            echo '<div class="jumbotron row mt-2 ml-1 mr-1">';
//            var_dump($blog);
            $this->view('AddBlog');

            $this->model('User');
            $this->model->setUser($_SESSION['User_Id']);

            $content = $this->model->getFirstName() . " " . $this->model->getLastName();
            $data = [
                $blog->getArticleTitle(),
                $blog->getArticle(),
                $content,
                $blog->getCreatedDate(),
                $blog->getModifiedDate(),
                $blog->getArticleId()
            ];
            $this->view('Blog', $data);
            echo '</div>';
        }

        $this->view('template/FooterView');
    }

    function getArticle($userId = 1)
    {
        $userId = $_SESSION["User_Id"];
        $this->model('Article');
        $blogs = $this->model->getBlogs($userId);

        $this->view('template/HeaderView');

        if ($blogs instanceof \PDOException) {

            echo '<div class="jumbotron ">';
            $data = ["alert-info", $blogs->getMessage()];
            $this->view('template/Alert', $data);
            echo '</div>';

        } elseif ('No Data' === $blogs[0]) {

            echo '<div class="jumbotron row ml-5 mr-5">';
            $this->view('AddBlog');
            $this->view('No Blog');
            echo '</div>';

        } else {
            echo '<div class="jumbotron row mt-2 ml-1 mr-1">';
            $this->view('AddBlog');
            foreach ($blogs as $x => $y) {
                $content = substr($y["Article"], 0, 50);
                $data = [
                    $y["Article_Title"],
                    $content,
                    $y["Article_Id"]
                ];
                $this->view('Blog Card', $data);
            }
            echo '</div>';
        }

        $this->view('template/FooterView');

    }

    function addArticle()
    {
        $this->model('Article');

        $result = $this->model->addArticle();

        if(!($result instanceof \PDOException)) {
            $this->Index();
        } else {
            $this->view('template/HeaderView');
            echo '<div class="jumbotron">';
            $data = ["alert-info", $result->getMessage(), '/article/getArticle'];
            $this->view('template/Alert', $data);
            echo '</div>';
            $this->view('template/FooterView');
        }
    }

    function updateArticle($aritcleId = 1)
    {

        $this->model('Article');

        $result = $this->model->updateArticle();

        if(!($result instanceof \PDOException)) {
            header('Location: /article/getArticle');
        } else {
            $this->view('template/HeaderView');
            echo '<div class="jumbotron">';
            $data = ["alert-info", $result->getMessage(), '/article/getArticle'];
            $this->view('template/Alert', $data);
            echo '</div>';
            $this->view('template/FooterView');
        }

    }

    function deleteArticle($articleId =1)
    {
        $this->model('Article');
        $this->model->deleteArticle($articleId);
        $this->Index();
    }

    function __toString()
    {
        // TODO: Implement __toString() method.
        return "Article Controller ";
    }
}
