<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 22/2/19
 * Time: 3:16 PM
 */

namespace models;

/**
 * Class Article
 * @package models
 */
class Article extends Model
{
    /**
     * @var
     */
    protected $articleId;
    /**
     * @var
     */
    protected $articleTitle;
    /**
     * @var
     */
    protected $article;
    /**
     * @var
     */
    protected $userId;
    /**
     * @var
     */
    protected $createdDate;
    /**
     * @var
     */
    protected $modifiedDate;

    /**
     * @return mixed
     */
    public function getArticleId()
    {
        return $this->articleId;
    }

    /**
     * @param mixed $articleId
     */
    public function setArticleId($articleId)
    {
        $this->articleId = $articleId;
    }

    /**
     * @return mixed
     */
    public function getArticleTitle()
    {
        return $this->articleTitle;
    }

    /**
     * @param mixed $articleTitle
     */
    public function setArticleTitle($articleTitle)
    {
        $this->articleTitle = $articleTitle;
    }

    /**
     * @return mixed
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param mixed $article
     */
    public function setArticle($article)
    {
        $this->article = $article;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param mixed $createdDate
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

    /**
     * @return mixed
     */
    public function getModifiedDate()
    {
        return $this->modifiedDate;
    }

    /**
     * @param mixed $modifiedDate
     */
    public function setModifiedDate($modifiedDate)
    {
        $this->modifiedDate = $modifiedDate;
    }

    /**
     * @return array|bool|\Exception|\PDOException|null
     */
    function addArticle()
    {
        $result = null;

        $articleTitle = $_POST["article-title"];
        $article = $_POST["article"];

        if("" === $article || "" === $articleTitle)
            return false;

        $query = 'INSERT INTO
              `Article`(
                `Article_Title`,
                `Article`,
                `User_Id`,
                `Created_Date`,
                `Modified_Date`
              )
            VALUES(
              :value0,
              :value1,
              :value2,
              CURRENT_TIMESTAMP,
              CURRENT_TIMESTAMP
            )';
        $params = [
            ':value0' => $articleTitle,
            ':value1' => $article,
            ':value2' => $_SESSION['User_Id']
        ];

        $result = $this->db->querySQL($query, $params);
//
        if ($result instanceof \PDOException) {
            return $result;
        }else {
            $blog = new Article();
            foreach($result as $x => $y){
                $blog->setArticleId($result[$y]["Article_Id"]);
                $blog->setArticleTitle($result[$y]["Article_Title"]);
                $blog->setArticle($result[$y]["Article"]);
                $blog->setUserId($result[$y]["User_Id"]);
                $blog->setCreatedDate($result[$y]["Created_Date"]);
                $blog->setModifiedDate($result[$y]["Modified_Date"]);
            }
            return $blog;
        }
        
    }

    function getOneBlog($articleId = 1)
    {
        $result = null;

        $query = 'SELECT 
                `Article_Id`,
                `Article_Title`,
                `Article`,
                `User_Id`,
                `Created_Date`,
                `Modified_Date`
                from `Article` as a where 
                `Article_Id` = :value0'
        ;
        $params = [':value0' => $articleId ];

        $result = $this->db->querySQL($query, $params);

        if ($result instanceof \PDOException) {
            return $result;
        }else {
            $blog = new Article();
            foreach($result as $x => $y){
//                echo 'Hello';
//                var_dump($y["Article_Id"]);
                $blog->setArticleId($y["Article_Id"]);
                $blog->setArticleTitle($y["Article_Title"]);
                $blog->setArticle($y["Article"]);
                $blog->setUserId($y["User_Id"]);
                $blog->setCreatedDate($y["Created_Date"]);
                $blog->setModifiedDate($y["Modified_Date"]);
            }
            return $blog;
        }
    }

    /**
     * @param int $userId
     * @return array|string
     */
    function getBlogs($userId = 1)
    {
        $result = null;

        $query = 'SELECT 
                `Article_Id`,
                `Article_Title`,
                `Article`,
                `User_Id`,
                `Created_Date`,
                `Modified_Date`
                from `Article` where 
                `User_Id` = :value0'
        ;
        $params = [':value0' => $userId ];

        $result = $this->db->querySQL($query, $params);

        return $result;

    }

    function updateArticle($articleId)
    {
        $query = 'UPDATE
              `Article`
            SET
              `Article_Title` = :value0,
              `Article` = :value1,
              `Modified_Date` = CURRENT_TIMESTAMP
            WHERE 
                `Article_Id` = :value2'
        ;

            $params = [
                ":value0" => $_POST["article-title"],
                ":value1" => $_POST["article"],
                ":value2" => $articleId
            ];

            $result = $this->db->querySQL($query, $params);

            return $result;

    }

    function deleteArticle($articleId)
    {
        $query = 'DELETE FROM 
            `Article` WHERE 
            `Article_Id` = :value0'
        ;
        $params = [':value0' => $articleId ];

        $result = $this->db->querySQL($query, $params);

    }
}