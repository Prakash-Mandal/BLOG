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

    private $conn = null;

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

            $this->conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION);

            return $this->conn;

        } catch (\PDOException $pdoe) {

            //catching Exception
            return $pdoe;
        }
    }

    public function querySQL($query = '', $params = [])
    {
        try {
            //binding sql query
            $stmt = $this->conn->prepare($query);

            //executing the sql query
            if ($stmt->execute($params)) {
                // output data of each row
                $rows = $stmt->fetchALL(PDO::FETCH_ASSOC);

                return 0 === count($rows)? [] : $rows;

            } else {
                return $stmt->error;
            }

        } catch (\PDOException $pdoe) {
            return $pdoe;
        }

    }

    public function stopConnection()
    {
        $this->conn = null;
        $this->host = null;
        $this->username = null;
        $this->password = null;
        $this->database = null;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.

        if(null !== $this->conn)
            return 'Connection Established';
        else
            return 'Connection Ended or Interrupted';
//            return '<pre>' . $this->pdoe->__toString() . '</pre>';

    }

}