<?php
namespace App\Data\Mapper;

use App\Data\Mapper;
use App\Data\Paginate;

class ShiftMapper extends Mapper
{

    protected $entity = 'App\Data\Entity\Shift';

    public function getShifts($options = [])
    {
        $options += [
            'user_id' => false,
        ] + Paginate::$defaultOptions;

        $paginate = new Paginate($options);

        $query = $this->db->from('shifts');

        if ($uid = $options['user_id']) {
            $query->where('user_id', $uid);
        }

        $result = $paginate->execute($query);

        return [$this->mapObjects($result), $paginate];
    }
}