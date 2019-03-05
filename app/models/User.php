<?php

namespace models;

class User extends Model
{
    protected $userId = 0;
    protected $firstName = "";
    protected $lastName = "";
    protected $emailId = "";

    private $password = "";

    public function __construct() {
        parent::__construct();
        $this->db->startConnection();
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
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmailId()
    {
        return $this->emailId;
    }

    /**
     * @param mixed $emailId
     */
    public function setEmailId($emailId)
    {
        $this->emailId = $emailId;
    }

    public function checkMail($email){
        $query = 'SELECT
              `Email_Id`
            FROM
              `Blog_User`
            WHERE
              `Email_Id` = :value0';
        $params =[ "value0" => $email];

        $result = $this->db->querySQL($query, $params);
        $this->db->stopConnection();

        return $result[0]["Email_Id"];
    }

    protected function setUser($userId = 1)
    {
        $query = 'SELECT
              `First_Name`,
              `Last_Name`,
              `Email_Id`,
              `Created_On`,
              `Modified_On`
            FROM
              `Blog_User`
            WHERE
              `User_Id` = ' . $userId;

        $result = $this->db->querySQL($query);
        $this->db->stopConnection();

        foreach ($result as $userKey => $userValue) {
            $this->setUserId($userId);
            $this->setFirstName($userValue["First_Name"]);
            $this->setLastName($userValue["Last_Name"]);
            $this->setEmailId($userValue["Email_Id"]);
        }
    }

    public function validateUser()
    {
        $emailId = \ValidationHelper::validateInput($_POST["u_email"]);
        $password = \ValidationHelper::validateInput($_POST["pass"]);
        $password = hash(
                'gost',
                $emailId.$password,
                false) . ':' .
            $password
        ;

        $sql = 'Select 
              `User_Id`,
              `First_Name`,
              `Last_Name`,
              `Email_Id`, 
              `Password` 
            FROM `Assignments`.`Blog_User` 
            WHERE Email_Id = :value0
        ';
        $params = [
            ":value0" => $emailId
        ];

        $result = $this->db->querySQL($sql, $params);
        $this->db->stopConnection();

        if ($result instanceof \PDOException) {

            $message = $result->errorInfo;
            return $message[2];
        } else {

            $this->setUserId($result[0]["User_Id"]);
            $this->setFirstName($result[0]["First_Name"]);
            $this->setLastName($result[0]["Last_Name"]);
            $this->setEmailId($result[0]["Email_Id"]);
            $this->password = $result[0]["Password"];
            if ($password === $this->password) {

                $_SESSION["name"] = $this->getFirstName() . ' ' . $this->getLastName() ;
                $_SESSION['User_Id'] = $this->getUserId();
                $_SESSION['email'] = $this->getEmailId();
                $_SESSION['login'] = "true";

                return true;
            }
            return false;
        }

    }

    public function addUser()
    {
        $this->setFirstName(\ValidationHelper::validateInput($_POST["first_name"]));
        $this->setLastName(\ValidationHelper::validateInput($_POST["last_name"]));
        $this->setEmailId(\ValidationHelper::validateInput($_POST["email"]));
        $this->password = \ValidationHelper::validateInput($_POST["pass"]);

        $this->password = hash(
            'gost',
            $this->getEmailId().$this->password,
            false) . ':' .
            $this->password;


        $sql = 'INSERT INTO Assignments.Blog_User(`First_Name`,`Last_Name`,
            `Email_Id`,`Password`) VALUES( :value0 , :value1, :value2, :value3)';
        $param = [
            ":value0" => $this->getFirstName(),
            ":value1" => $this->getLastName(),
            ":value2" => $this->getEmailId(),
            ":value3" => $this->password
        ];

        $result = $this->db->querySQL($sql, $param);

        $this->db->stopConnection();

        return $result;

    }

    public function __toString()
    {
        // TODO: Change the autogenerated stub

        $text = parent::__toString();
        $text .= "<br>Name : " . $this->getFirstName() . ' ' . $this->getLastName() . '<br>';
        $text .= "Email Id : " . $this->getEmailId() . '<br>';
        $text .= "User Id : " . $this->getUserId() . '<br>';
        return $text;
    }

}