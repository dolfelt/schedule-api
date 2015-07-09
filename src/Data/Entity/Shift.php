<?php
namespace App\Data\Entity;

use App\Data\Entity;

class Shift extends Entity
{

    protected $transformer = 'App\Data\Transformer\ShiftTransformer';

    protected $properties = [
        'id',
        'account_id',
        'user_id',
        'location_id',
        'position_id',
        'start_time',
        'end_time',
        'created_at',
        'updated_at',
    ];

    protected $account_id;
    protected $user_id;
    protected $location_id;
    protected $position_id;
    protected $start_time;
    protected $end_time;


    public function getAccountId()
    {
        return $this->account_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getLocationId()
    {
        return $this->location_id;
    }

    public function getPositionId()
    {
        return $this->position_id;
    }

    public function getStartTime()
    {
        return $this->getDate($this->start_time);
    }

}