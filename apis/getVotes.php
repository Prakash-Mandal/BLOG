<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 3/3/19
 * Time: 10:13 PM
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../core/config/Database.php';
require_once '../core/classes/model.php';
require_once '../app/models/Votes.php';

use models\Votes;

$articleId = $_GET["articleId"];
$userId = $_GET["userId"];
$vote = $_GET["vote"];
$voteType = $_GET["voteType"];


$votes = new Votes();

$votes->putVotes($articleId, $userId, $vote);
$voteCount = $votes->getVotes($articleId);


echo json_encode(array(
    "VoteCount" => $voteCount,
    "ArticleId" => $articleId,
    "UserId" => $userId,
    "Vote" => $vote,
    "VoteType" => $voteType
));

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);