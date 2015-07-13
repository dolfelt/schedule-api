<?php
namespace App\Data\Mapper;

use App\Data\Mapper;
use App\Data\Paginate;

class LoginMapper extends Mapper
{

    protected $entity = 'App\Data\Entity\Login';

    public function getLoginById($id)
    {
        return $this->mapObject(
            $this->db->from('logins')->where('id', $id)->fetch()
        );
    }

    public function getLoginByEmail($email)
    {
        $query = $this->db->from('logins')
            ->where('email', $email);

        return $this->mapObject(
            $query->fetch()
        );
    }

}