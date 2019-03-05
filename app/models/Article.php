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
     * @var
     */
    public $author;

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
     * @param string $first
     * @param string $last
     */
    protected function authorName($first = '', $last = '')
    {
        $this->author = $first . ' ' . $last;
    }

    /**
     * @return array|bool|\Exception|Article|null
     */
    function addArticle()
    {
        $result = null;

        $articleTitle = \ValidationHelper::validateInput($_POST["article-title"]);
        $article = \ValidationHelper::validateInput($_POST["article"]);
        var_dump($article);

        if(empty($article) || empty($articleTitle))
            return false;

        $query = 'INSERT INTO
              `Article`(
                `Article_Title`,
                `Article`,
                `User_Id`,
                `Created_Date`,
                `Modified_Date`,
                `Status`
              )
            VALUES(
              :value0,
              :value1,
              :value2,
              :value3,
              :value3,
              TRUE
            )';
        $params = [
            ':value0' => $articleTitle,
            ':value1' => $article,
            ':value2' => $_SESSION['User_Id'],
            ':value3' => \Utilities::getTime()
        ];

        $result = $this->db->querySQL($query, $params);

        return $result;

    }

    /**
     * @param int $articleId
     * @return array|\Exception|Article|\PDOException|null
     */
    function getOneBlog($articleId = 1)
    {
        $result = null;

        $query = 'SELECT 
                a.`Article_Id`,
                a.`Article_Title`,
                a.`Article`,
                a.`User_Id`,
                a.`Created_Date`,
                a.`Modified_Date`,
                b.`First_Name`,
                b.`Last_Name`
                FROM `Article` a JOIN `Blog_User` b ON a.`User_Id` = b.`User_Id`
                WHERE
                a.`Article_Id` = :value0 AND a.`Status` = TRUE
        ';
        $params = [':value0' => $articleId ];

        $result = $this->db->querySQL($query, $params);

        if ($result instanceof \PDOException) {
            return $result;
        }else {
            $blog = new Article();
            foreach($result as $articleKey => $articleValue){
                $blog->setArticleId($articleValue["Article_Id"]);
                $blog->setArticleTitle($articleValue["Article_Title"]);
                $blog->setArticle($articleValue["Article"]);
                $blog->setUserId($articleValue["User_Id"]);
                $blog->setCreatedDate($articleValue["Created_Date"]);
                $blog->setModifiedDate($articleValue["Modified_Date"]);
                $blog->authorName(
                    $articleValue["First_Name"],
                    $articleValue["Last_Name"]
                );
            }
            return $blog;
        }
    }

    /**
     * @param int $userId
     * @return array|string
     */
    function getBlogsExcept($userId = 1)
    {
        $result = null;

        $query = 'SELECT 
                a.`Article_Id`,
                a.`Article_Title`,
                a.`Article`,
                a.`User_Id`,
                a.`Created_Date`,
                a.`Modified_Date`,
                b.`First_Name`,
                b.`Last_Name`
                FROM `Article` a JOIN `Blog_User` b ON a.`User_Id` = b.`User_Id`
                WHERE
                a.`Article_Id` != :value0 AND a.`Status` = TRUE
        ';
        $params = [':value0' => $userId ];

        $result = $this->db->querySQL($query, $params);

        return $result;

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
                `Modified_Date`,
                `Status`
                from `Article` where 
                `User_Id` = :value0
                AND
                `Status` = true
        ';
        $params = [':value0' => $userId ];

        $result = $this->db->querySQL($query, $params);

        return $result;

    }

    /**
     * @param $articleId
     * @return array|\Exception|\PDOException
     */
    function updateArticle($articleId)
    {
        var_dump($_POST);
        $query = 'UPDATE
              `Article`
            SET
              `Article` = :value1,
              `Modified_Date` = CURRENT_TIMESTAMP
            WHERE 
                `Article_Id` = :value2'
        ;
        $params = [
            ":value1" => $_POST["article"],
            ":value2" => $articleId
        ];

        $result = $this->db->querySQL($query, $params);

        return $result;

    }

    /**
     * @param $articleId
     * @return boolean
     */
    function deleteArticle($articleId)
    {
        $query = 'UPDATE
              `Article`
            SET
                `Status` = FALSE
            WHERE 
                `Article_Id` = :value0
        ';
        $params = [':value0' => $articleId ];

        $result = $this->db->querySQL($query, $params);


        if(!($result instanceof PDOException))
        {
            return true;
        }
        return false;
    }

    /**
     * @return string
     */
    function __toString()
    {
        // TODO: Change the autogenerated stub
        $text = 'Article_Id : ' . $articleId;
        return $text;
    }
}