<?php
namespace App\Data\Entity;

use App\Data\Authenticator;
use App\Data\Entity;

class Login extends Entity
{

    protected $transformer = 'App\Data\Transformer\LoginTransformer';

    protected $properties = [
        'id',
        'first_name',
        'last_name',
        'email',
        'password',
        'created_at',
        'updated_at',
    ];

    protected $account_id;
    protected $role;
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $password;


    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function hasPassword()
    {
        return !empty($this->password);
    }

    public function setPassword($password)
    {
        $this->password = Authenticator::hashPassword($password);
        return $this;
    }

}