<?php

namespace models;

/**
 * Class Votes
 * @package models
 */
class Votes extends Model
{
    /**
     * @param $articleId
     * @param $userId
     * @return bool|\Exception
     */
    private function checkVote($articleId, $userId)
    {
        $query = "SELECT
                  `Status`
                FROM
                  `Votes`
                WHERE
                `Article_Id` = :value0
                AND
                `User_Id` = :value1" ;

        $params = [
            ":value0" => $articleId,
            ":value1" => $userId
        ];

        $result = $this->db->querySQL($query, $params);

        if(0 === count($result)) {
            return false;
        } else {
           return true;
        }
    }

    /**
     * @param $articleId
     * @return int
     */
    public function getVotes($articleId)
    {
        $query = 'SELECT
              COUNT(v.`Status`)
            FROM
              `Votes` v
            WHERE
            v.`Article_Id` = :value0 
            AND
            v.`Status` = 1 ';
        $params = [
            ":value0" => $articleId
        ];

        $result = $this->db->querySQL($query, $params);

        if(0 === count($result)) {
            return 0;
        } else {
            return $result[0]["COUNT(v.`Status`)"];
            // foreach($result as $key => $value){
                // return $value['COUNT(v.`Status`)'];
        }
    }


    /**
     * @param $articleId
     * @param $userId
     * @param $vote
     * @void
     */
    public function putVotes($articleId, $userId, $vote)
    {

        if($this->checkVote($articleId, $userId)) {
            $query = 'UPDATE
                    Votes
                SET
                    Status = :value0
                WHERE
                    Article_Id = :value1
                AND
                    User_Id = :value2
                    ';
        } else {
            $query = 'INSERT INTO 
                Votes(
                    Article_Id,
                    User_Id,
                    Status
                ) Values (
                    :value1,
                    :value2,
                    :value0
                )';
        }
        $params = [
            ":value0" => $vote,
            ":value1" => $articleId,
            ":value2" => $userId
        ];
        if ($this->db->querySQL($query, $params))
            return true;
        else
            return false;

    }
}


