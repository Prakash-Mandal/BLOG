<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../core/config/Database.php';
require_once '../core/classes/model.php';
require_once '../app/models/User.php';

$mail = $_GET["email"];
if ("" === $mail){
	$mail = "No email provided";
}

$mails = new \models\User();

$result = $mails->checkMail($mail);

if ($result) {
    $text = $result;
    echo json_encode(array("email" => $mail, "value" => true, "present_email" => $text, "message" => "Email already present"));
}else {
    $text = "";
    echo json_encode(array("email" => $mail, "value" => false, "present_email" => "", "message" => "Proceed OK"));
}






/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 7/2/19
 * Time: 3:23 PM
 */