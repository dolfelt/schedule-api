<?php
namespace App\Data\Mapper;

use App\Data\Mapper;
use LessQL\Database;

class ShiftMapper extends Mapper
{


    public function getShifts($options = [])
    {
        return $this->db->shifts()
            ->fetchAll();
    }
}