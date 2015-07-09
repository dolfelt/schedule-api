<?php
namespace App\Data\Entity;

use App\Data\Entity;

class Position extends Entity
{

    protected $properties = [
        'id', 'user_id', 'start_time', 'end_time',
    ];


}