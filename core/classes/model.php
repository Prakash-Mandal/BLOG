<?php

namespace models;

use config\Database;

/**
 * 
 */
class Model
{
    protected $db;

	function __construct()
	{
		# code...

        $this->db = new Database();

	}

    public function __toString()
    {
	    // TODO: Implement __toString() method.
        return "Model is called";
    }
}