<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 22/2/19
 * Time: 3:16 PM
 */

namespace models;


class Comment extends Model
{
    protected $commentId;
    protected $comment;
    protected $userId;
    protected $articleId;
    protected $createdOn;

    /**
     * @return mixed
     */
    public function getCommentId()
    {
        return $this->commentId;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function getArticleId()
    {
        return $this->articleId;
    }

    /**
     * @return mixed
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    function addComment()
    {
        $query = 'INSERT INTO
                `Comment`(
                  `Comment_Data`,
                  `User_Id`,
                  `Article_Id`,
                  `Created_On`
                )
                VALUES (
                  :value0,
                  :value1,
                  :value2,
                  :value3
                )';
        $params = [
            ":value0" => \ValidationHelper::validateInput($_POST["comment"]),
            ":value1" => \ValidationHelper::validateInput($_POST["userId"]),
            ":value2" => \ValidationHelper::validateInput($_POST["articleId"]),
            ":value3" => \Utilities::getTime()
        ];

        $result = $this->db->querySQL($query, $params);

        return $result;

    }

    function getComments($articleId, $limit)
    {
        $query = 'SELECT
              `Comment_Id`,
              `Comment_Data`,
              `User_Id`,
              `Article_Id`,
              `Created_On`,
              `Status`
            FROM
              `Comment`
            WHERE
              `Article_Id` = :value0 AND 
              `Status` = TRUE
            LIMIT :value1
        ';
        $params = [
            ":value0" => $articleId,
            ":value1" => $limit
        ];

        $result = $this->db->querySQL($query, $params);

        if ($result instanceof \PDOException) {

            return $result;
        }else {
            if("No Data" === $result) {
                return null;
            } else {
                $comments = [];
                foreach ($result as $commentKey => $commentValue) {
                    $comment = new Comment();
                    $comment->commentId = $commentValue["Comment_Id"];
                    $comment->comment = $commentValue["Comment_Data"];
                    $comment->userId = $commentValue["User_Id"];
                    $comment->articleId = $commentValue["Article_Id"];
                    $comment->createdOn = $commentValue["Created_Date"];
                    array_push($comments, $comment);
                }
                return $comments;
            }
        }

    }

    function deleteComment($commentId)
    {
        $query = 'UPDATE
                `Comment`
                SET
                `Status` = FALSE
                WHERE
                `Comment_Id` = :value0';
        $params = [
            ':value0' => $commentId
        ];

        return $this->db->querySQL($query, $params);

    }

}