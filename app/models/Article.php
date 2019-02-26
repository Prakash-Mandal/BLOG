<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 22/2/19
 * Time: 3:16 PM
 */

namespace models;


class Article extends Model
{
    function callingBlogs()
    {
        $query = $sql = 'SELECT `Article_Title`,`Article`,`Created_Date` 
                from Article where `User_Id` = :value0';
        $params = [':value0' => $_SESSION['User_Id'] ];

        $retval = $this->db->querySQL($query, $params);

        if (0 === count($retval)) {

        }

        $var = mysqli_num_rows($retval);

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

        <?php }
    }

}