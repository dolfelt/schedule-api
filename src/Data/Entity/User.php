<?php
namespace App\Data\Entity;

use App\Data\Entity;

class User extends Entity
{

    protected $transformer = 'App\Data\Transformer\UserTransformer';

    protected $properties = [
        'id',
        'account_id',
        'role',
        'first_name',
        'last_name',
        'email',
        'created_at',
        'updated_at',
    ];

    protected $account_id;
    protected $role;
    protected $first_name;
    protected $last_name;
    protected $email;

    // TODO: How do we deal with realtionships
    protected $locations;
    protected $positions;


    public function getAccountId()
    {
        return $this->account_id;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getLocations()
    {
        return $this->locations;
    }

    public function getPositions()
    {
        return $this->positions;
    }

    public function getPositionId()
    {
        return $this->position_id;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getFullName()
    {
        return implode(" ", [$this->first_name, $this->last_name]);
    }

}