<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 24/2/19
 * Time: 8:30 PM
 */

namespace controller;

class Login extends Controller {

    /*
     * http://localhost/login
     */
    function Index() {

        if (!isset($_SESSION['login'])) {

            $this->view('template/HeaderView');
            $this->view('SignUpView');
            $this->view('template/FooterView');

        } else {

            header('Location: /?');

        }

    }

    public function emptyData()
    {

    }

    /*
     * http://localhost/login/validating
     */
    function validating () {

        // Loads /models/User.php
        $this->model('User');

        $result = $this->model->validateUser();


        if (1 === count($result)) { // User->validateUser() from /models/User.php

            $_SESSION["name"] = $result[0]["First_Name"] . $result[0]["Last_Name"] ;

            $data = [$result[0]["First_Name"], $result[0]["Last_Name"]];
            $this->view('template/HeaderView' , [$data]);
            $this->view('Dashboard');
            $this->view('template/FooterView');

        } else {

            $data ='Error... No such Data';
            $this->view('template/HeaderView', $data);
//            $this->view('template/Modal', $data);
            $this->view('SignUpView');
            $this->view('template/FooterView');


        }



    }

    function callingBlogs()
    {

        if ($var > 0) {
            while ($row = mysqli_fetch_assoc($retval)) { ?>
                <h4 class="panel-title">
                    <a class="btn btn-success btn-group " name="article-title"
                       data-toggle="collapse" href="#collapse<?php echo $var; ?>">
                        <?php echo $row["Article_Title"] ?>
                        <small class="text-dark ml-md-3">
                            <?php echo $row["Created_Date"]; ?>
                        </small>
                    </a>
                </h4>
                <div id="collapse<?php echo $var; ?>" class="panel-collapse collapse">
                    <div class="panel-body">
                        <form class=form-inline method="GET" onsubmit="return promptUpdate()">
                            <textarea class="form-control" name="article" rows="10" cols="50">
                                <?php echo $row["Article"]; ?> </textarea>
                            <div class="form-group mt-md-3 ml-md-2">
                                <button class="btn btn-primary mr-md-2" name="updateBlog"
                                        type="submit" value="<?php echo $row["Article_Title"]; ?>">
                                    Update
                                </button>
                        </form>
                        <form method="POST" onsubmit=" return promptDelete()">
                            <button class="btn btn-danger" name="deleteBlog"
                                    type="submit" value="<?php echo $row["Article_Title"] ?>">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
                </div>
                <?php $var--;
            }
        } else { ?>
            <h4 class="panel-title">
                <a class="btn btn-success btn-block"
                   data-toggle="collapse" href="#collapse">
                    Start your blog
                    <small>
                        <?php echo date('d/m/Y'); ?>
                    </small>
                </a>
            </h4>
            <div id="collapse" class="panel-collapse collapse">
                <div class="panel-body">
                    Write out your life ...
                    <br>Everyone\'s waiting....
                </div>
            </div>
        <?php }
    }

    /*
     * http://localhost/login/logout
     */
    function logout () {

        $_SESSION = [];
        session_unset();
        header('Location: /');

    }

}
