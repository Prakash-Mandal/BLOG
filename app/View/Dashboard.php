<?php
namespace View;

use Controller\Controller;
use Model\User;

class Dashboard
{
  public function __construct(){
    if(session_status()){
      session_start();
    }
  }

  public function dashboard($name)
  {
    $name = $_SESSION['name'];
    $email = $_SESSION["email"];
    $user = new User();
  }
}

$controller = new Controller();

?>
<!DOCTYPE html>
<html lang="en">
    <body>
        <div class="container-fluid">
            <div class="jumbotron row">
            <div class="col-md-7">
                <?php $controller->callingBlogs(); ?>
            </div>
            <div class="col-md-5">
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse"
                                href="#addBlog">
                                    Add Blog
                                </a>
                            </h4>
                        </div>
                        <div id="addBlog" class="panel-collapse collapse">
                            <form id="ArticleForm" class="form-group">
                                <input type="text" id="article-title" name="article-title"
                                    class="form-control" placeholder="Article Title">
                                <textarea class="form-control" id="article" name="article"
                                    rows="10" placeholder="Write it out...">
                                </textarea>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#ArticleValidation"
                                type="submit" name="addBlog" value="true" onclick="validateArticle(this.form)">
                                    Add Blog
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal" id="ArticleValidation">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Modal Heading</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            Modal body..
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
