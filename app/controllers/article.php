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
            // $this->getArticle($_SESSION['User_Id']);
        } else {

            header('Location: /login');

        }

    }

    function showArticle($articleId = 1)
    {

        $this->model('Article');
        $blog = $this->model->getOneBlog($articleId);

        $comments = null;
        $this->model('Comment');
        $comments = $this->model->getComments($articleId, 2);

        $this->view('template/HeaderView');

        if ($blog instanceof \PDOException) {

            echo '<div class="jumbotron ">';
            $message = $blog->errorInfo;
            $data = ["alert-info", "Article Error : " . $message[2], '/article/getArticle'];
            $this->view('template/Alert', $data);
            echo '</div>';
        } elseif ($comments instanceof \PDOException) {

            echo '<div class="jumbotron ">';
            $message = $comments->errorInfo;
            $data = ["alert-info", "Comment Error : " . $message[2], '/article/getArticle'];
            $this->view('template/Alert', $data);
            echo '</div>';

        } else {

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

            echo '<div id="Comments" class="ml-5 mb-3 col-8">';

            if (null !== $comments) {
                foreach ($comments as $y => $x) {
                    $data = [
                        $x["comment"],
                        $x["userName"],
                        $x["createdOn"]
                    ];
                    $this->view('Comment Card', $data);
                }
            }
            echo '</div>';

            echo '<div>
                    <BUTTON id="AddComment" class="btn btn-secondary"> More Comments..</BUTTON>
                    <a class="btn btn-secondary text-white ml-3 mr-md-2" data-toggle="modal" data-target="#addComment" name="addComment"
                       type="submit" >
                        Add Comment
                    </a>';
            echo '  <a href="/article" class="link text-primary ml-3">
                            Return to previous Page.
                        </a>
                    </div> </div>';
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
            $message = $blogs->errorInfo;
            $data = ['alert-info', $message[2], '/login'];
            $this->view('template/Alert', $data);
            echo '</div>';

        } elseif ('No Data' === $blogs) {

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

    function moreArticle()
    {

    }

    function addArticle()
    {
        $this->model('Article');
        $result = $this->model->addArticle();

        if(!$result) {

            $this->view('template/HeaderView');
            echo '<div class="jumbotron">';
            $data = ["alert-info", "Article Not Added", '/article/getArticle'];
            $this->view('template/Alert', $data);
            echo '</div>';
            $this->view('template/FooterView');
        } else {

            $this->Index();
        }
    }

    function updateArticle()
    {
        $articleId = $_POST["updateBlog"];
        $this->model('Article');

        $result = $this->model->updateArticle($articleId);

        if(!is_string($result)) {

            header('Location: /article/showArticle/' . $articleId);
        } else {

            $this->view('template/HeaderView');
            echo '<div class="jumbotron">';
            $data = ["alert-info", $result, '/article/getArticle'];
            $this->view('template/Alert', $data);
            echo '</div>';
            $this->view('template/FooterView');
        }

    }

    function deleteArticle()
    {

        $articleId = $_POST['deleteArticle'];
        echo $articleId;
        $this->model('Article');

        $result = $this->model->deleteArticle($articleId);
        if ($result) {
            echo '<script> alert("Deleted"); </script> ';
            header('Location: /dashboard');
        } else {
            echo '<script> alert("NOT Deleted"); </script> ';
            header('Location: /article/showArticle/' . $articleId);
        }

    }

    function __toString()
    {
        // TODO: Implement __toString() method.
        return "Article Controller ";
    }
}
