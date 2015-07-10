<?php
namespace App\Data;

use App\Data\Entity\User;

class Permissions {

    /**
     * @var Authenticator
     */
    protected $auth;

    /**
     * @var User
     */
    protected $user;

    public function __construct(Authenticator $auth)
    {
        $this->auth = $auth;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    // Check the user for authentication
    public function can($perm)
    {
        if (!$this->user) {
            return false;
        }

        if ($this->user->getRole() == $perm) {
            return true;
        }

        return false;
    }
}