<?php
namespace App\Data;

abstract class Entity implements \JsonSerializable
{
    protected $id;
    protected $createdAt;
    protected $updatedAt;
    protected $deleted = false;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = (int)$id;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = strtotime($createdAt);
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = strtotime($updatedAt);
    }

    public function getDeleted()
    {
        return $this->deleted;
    }

    public function setDeleted($deleted)
    {
        $this->deleted = (bool)$deleted;
    }

    public function jsonSerialize()
    {
        return $this->getData();
    }

    /**
     * TODO: Rename, could interfere if a record has a data column
     *
     * @return array
     */
    abstract public function getData();
}