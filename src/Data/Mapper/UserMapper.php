<?php
namespace App\Data\Mapper;

use App\Data\Mapper;
use App\Data\Paginate;

class UserMapper extends Mapper
{

    protected $entity = 'App\Data\Entity\User';

    public function getUserById($id)
    {
        return $this->db->from('users')->where('id', $id)->fetch();
    }

    public function getUsers($options = [])
    {
        $options += [

        ] + Paginate::$defaultOptions;

        $paginate = new Paginate($options);

        $query = $this->db->from('users');

        $result = $paginate->execute($query);

        return [$this->mapObjects($result), $paginate];
    }
}