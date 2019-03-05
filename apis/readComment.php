<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 1/3/19
 * Time: 12:04 PM
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

/*
 * database connection will be here
 */

// include database and object files
require_once '../config/Database.php';
require_once '../objects/Comments.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$comments = new \objects\Comments($db);

/*
 * read products will be here
 */

$get_article_id = $_POST["article_id"];
$get_limit = $_POST["limit"];

//$get_article_id = 1;
//$get_limit = 4;

$stmt = $comments->getComments($get_article_id, $get_limit);

//echo json_encode(["one" => 1]);
// check if more than 0 record found
if (!($stmt instanceof \PDOException)){


    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode([
        "Message" => "Data Found",
        "data" => $stmt
    ]);

} else {

    /*
     * no products found will be here
     */
    $message = $stmt->errorInfo;

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode([
        "Message" => "No comments found",
        "Data" => $message[2]
    ]);
}

//
//var_dump($result);
//
//if ($result instanceof \PDOException) {
//
//    echo json_encode(array(
//        "article" => $article_id,
//        "limit" => $limit,
//        $text => null,
//        "present_comments" => false,
//        "message" => $result->getMessage()
//    ));
//}else {
//
//    if (0 !== $result->rowCount()) {
//        echo json_encode(array(
//            "article" => $article_id,
//            "limit" => $limit,
//            $text => null,
//            "present_comments" => false,
//            "message" => "No comments till now"
//        ));
//    } else {
//        $comments = array();
//        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
//            array_push($comments, $row);
//            foreach ($row as $commentKey => $commentValue) {
//                $data = "{";
//                $data .= $commentKey . '=>' . $commentValue["Comment_Id"];
//                $data .= $commentKey . '=>' . $commentValue["Comment_Data"];
//                $data .= $commentKey . '=>' . $commentValue["User_Id"];
//                $data .= $commentKey . '=>' . $commentValue["Article_Id"];
//                $data .= $commentKey . '=>' . $commentValue["Created_Date"];
//                $data .= "},";
////                array_push($comments, $data);
//            }
//        }
//        echo json_encode(array(
//            "article" => $article_id,
//            "limit" => $limit,
//            "present_comments" => true,
//            "message" => $comments
//        ));
//    }
//}