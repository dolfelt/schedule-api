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

    abstract protected function mapObjects(array $results);
}