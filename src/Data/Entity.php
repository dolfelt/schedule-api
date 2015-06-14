<?php
namespace App\Data;

class Entity
{
    protected $properties = [];

    protected $id;

    public function getId()
    {
        return $this->id;
    }
}