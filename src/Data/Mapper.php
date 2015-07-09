<?php
namespace App\Data;

abstract class Mapper
{
    /**
     * @var \FluentPDO
     */
    protected $db;

    protected $entity;

    public function __construct(\FluentPDO $db)
    {
        if (!$this->entity) {
            throw new \Exception('Must include an $entity parameter.');
        }
        $this->db = $db;
    }

    public function mapObjects($result)
    {
        $entity = new $this->entity;

        $output = [];
        foreach ($result as $row) {
            $object = clone $entity;
            $object->mapData($row);
            $output[] = $object;
        }

        return $output;
    }
}