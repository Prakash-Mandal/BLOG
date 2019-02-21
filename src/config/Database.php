<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 21/2/19
 * Time: 6:14 PM
 */

namespace config;

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
        $this->getConnection();
    }

    private function set()
    {

        $str = file_get_contents('config.json',true);
        $data = json_decode($str,true);

//        echo $str;
//        echo $data["Data"]["Database"][0]["host"];
//        echo $data["Data"]["Database"][1]["username"];
//        echo $data["Data"]["Database"][2]["password"];
//        echo $data["Data"]["Database"][3 ]["database"];

        $this->host = $data["Data"]["Database"][0]["host"];
        $this->username = $data["Data"]["Database"][1]["username"];
        $this->password = $data["Data"]["Database"][2]["password"];
        $this->database = $data["Data"]["Database"][3]["database"];

    }

    public function getConnection()
    {

        // Create connection
        $this->conn = new \mysqli($this->host, $this->username, $this->password);

        // Check connection
        if (mysqli_connect_error()) {
            die("Connection failed: " . mysqli_connect_error());
        }
        echo "Hello Connection<br>";
//        return $this->conn;
        $this->querySQL();
    }

    public function querySQL($query = '', $params = [])
    {
        echo "Hello Query<br>";

//        echo $this->conn;

        $query = 'Select * from Blog_User';
        $result = $this->conn->query($query);

        echo $result->num_rows . "<br>";

        // output data of each row
        if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "id: " . $row["User_Id"]. "<br>";
                }
            } else {
        echo "results 0";
}
        echo "Done query<br>";

    }

}