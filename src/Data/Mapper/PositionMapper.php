<?php
namespace App\Data\Mapper;

use App\Data\Mapper;
use App\Data\Paginate;

class PositionMapper extends Mapper
{

    protected $entity = 'App\Data\Entity\Position';

    public function getPositions($options = [])
    {
        $options += [
            'search' => false,
        ] + Paginate::$defaultOptions;

        $paginate = new Paginate($options);

        $query = $this->db->from('positions')->where('account_id', 5);

        if ($s = $options['search']) {
            $query->where('name LIKE ?', $s.'%');
        }

        $result = $paginate->process($query);

        return [$this->mapObjects($result), $paginate];
    }
}