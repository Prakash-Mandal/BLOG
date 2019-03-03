<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 2/3/19
 * Time: 1:49 PM
 */

namespace models;


class Votes
{
    public $votes;
    private $userId;
    private $articleId;

    protected function getVotes()
    {
        $query = 'Select count(`Status`)';

    }

}