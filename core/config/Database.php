<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 21/2/19
 * Time: 6:14 PM
 */

namespace config;

use PDO;

class Database
{
    private $host = '';
    private $username = '';
    private $password = '';
    private $database = '';

    protected $conn = null;

    public function __construct()
    {
        $this->set();
        $this->startConnection();
    }

    private function set()
    {

        $str = file_get_contents('config.json',true);
        $data = json_decode($str,true);

        $this->host = $data["Data"]["Database"][0]["host"];
        $this->username = $data["Data"]["Database"][1]["username"];
        $this->password = $data["Data"]["Database"][2]["password"];
        $this->database = $data["Data"]["Database"][3]["database"];

    }

    public function startConnection()
    {
        try {
            // Create connection
            $this->conn = new PDO(
                "mysql:host=$this->host;
                dbname=$this->database",
                $this->username,
                $this->password);

            //setting attributes
            $this->conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION);

        } catch (\PDOException $pdoe) {

            // Check connection
            //catching Exception
            echo $pdoe->getMessage();
        }

        return $this->conn;
    }

    public function querySQL($sql = '', $params = [])
    {
        //binding sql query
        $stmt = $this->conn->prepare($sql);


        //executing the sql query
        $stmt->execute($params);

        echo "Done query<br>";

        // output data of each row
        $rows = $stmt->fetchALL(PDO::FETCH_ASSOC);
        var_dump($rows);
        return $rows;


    }

    public function stopConnection()
    {
        $this->conn = null;
        $this->host = null;
        $this->username = null;
        $this->password = null;
        $this->database = null;
    }

}