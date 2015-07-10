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

        // Obviously needs to be redone, we don't want all positions
        $query = $this->db->from('positions');

        if ($s = $options['search']) {
            $query->where('name LIKE ?', $s.'%');
        }

        $result = $paginate->process($query);

        return [$this->mapObjects($result), $paginate];
    }

    protected function mapObjects(array $records)
    {
        $results = [];
        foreach ($records as $record) {
            $entity = new $this->entity;
            $entity->setId($record['id']);
            $entity->setAccountId($record['account_id']);
            $entity->setName($record['name']);
            $entity->setColor($record['color']);
            $entity->setSort($record['sort']);
            $entity->setCreatedAt($record['created_at']);
            $entity->setUpdatedAt($record['updated_at']);
            $entity->setDeleted($record['is_deleted']);

            $results[] = $entity;
        }

        return $results;
    }
}