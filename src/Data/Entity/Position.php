<?php
namespace App\Data\Entity;

use App\Data\Entity;

class Position extends Entity
{
    protected $accountID;
    protected $name;
    protected $color;
    protected $sort;

    public function getAccountId()
    {
        return $this->accountID;
    }

    public function setAccountId($accountID)
    {
        $this->accountID = (int)$accountID;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = ucwords($name);
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color)
    {
        $this->color = strtoupper($color);
    }

    public function getSort()
    {
        return $this->sort;
    }

    public function setSort($sort)
    {
        $this->sort = (int)$sort;
    }

    public function getData()
    {
        return [
            'id'         => $this->getId(),
            'account'    => $this->getAccountId(),
            'name'       => $this->getName(),
            'color'      => $this->getColor(),
            'sort'       => $this->getSort(),
            'deleted'    => $this->getDeleted(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }
}