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
        $output = [];
        foreach ($result as $row) {
            $output[] = $this->mapObject($row);
        }
        return $output;
    }

    public function mapObject($row)
    {
        $object = new $this->entity;
        $object->mapData($row);
        return $object;
    }
}