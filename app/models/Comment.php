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
                  `Article_Id`
                )
                VALUES (
                  :value0,
                  :value1,
                  :value2
                )';
        $params = [
            ":value0" => \ValidationHelper::validateInput($_POST["comment"]),
            ":value1" => \ValidationHelper::validateInput($_SESSION["User_Id"]),
            ":value2" => \ValidationHelper::validateInput($_POST["articleId"])
        ];

        $result = $this->db->querySQL($query, $params);
        return $result;

    }

    function getComments($articleId, $limit)
    {

        $query = "SELECT
                  c.`Comment_Id`,
                  b.`First_Name`,
                  b.`Last_Name`,
                  c.`Comment_Data`,
                  c.`User_Id`,
                  c.`Created_On`
                FROM
                  `Comment` c JOIN `Blog_User` b ON c.`User_Id` = b.`User_Id`
                WHERE
                c.`Article_Id` = :value0 AND `Status` = TRUE
                LIMIT " . $limit;

        $params = [
            ":value0" => $articleId,
        ];

        $result = $this->db->querySQL($query, $params);

        if ($result instanceof \PDOException) {

            return $result;
        }else {
            if("No Data" === $result) {
                return "No Data";
            } else {
                $comments = [];
                foreach ($result as $commentKey => $commentValue) {
                    $comment = [
                        "commentId" => $commentValue["Comment_Id"],
                        "comment" => $commentValue["Comment_Data"],
                        "userId" => $commentValue["User_Id"],
                        "userName" => $commentValue["First_Name"] . ' ' . $commentValue["Last_Name"],
                        "createdOn" => $commentValue["Created_On"]
                    ];
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