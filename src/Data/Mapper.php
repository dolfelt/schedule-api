<?php
namespace App\Data;

use LessQL\Database;

class Mapper
{
    /**
     * @var Database
     */
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }
}