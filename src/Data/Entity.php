<?php
namespace App\Data;

use Carbon\Carbon;

abstract class Entity implements \JsonSerializable
{
    protected $transformer;

    protected $properties = [];

    protected $id;

    private $data;

    private $callMethods = ['get', 'set'];

    public function __construct($data = [])
    {
        $this->mapData($data);
    }

    public function getId()
    {
        return $this->id;
    }

    public function has($field)
    {
        return array_key_exists($field, $this->properties) || in_array($field, $this->properties);
    }

    public function getDate($field)
    {
        return new Carbon($this->{$field});
    }

    public function getData()
    {
        $object = [];
        foreach ($this->properties as $k=>$v) {
            if (is_numeric($k)) {
                $k = $v;
                $v = null;
            }
            $object[$k] = $this->{$k};
        }

        return $object;
    }

    public function mapData(array $row)
    {
        foreach ($this->properties as $k=>$v) {
            if (is_numeric($k)) {
                $k = $v;
                $v = null;
            }
            if (!array_key_exists($k, $row)) {
                continue;
            }
            $this->{$k} = $row[$k];
        }
    }

    public function jsonSerialize()
    {
        if ($this->transformer) {
            $transform = new $this->transformer;
            return $transform($this);
        } else {
            return $this->data;
        }
    }

    /*public function __call($name, $args)
    {
        $action = substr($name, 0, 3);
        if (!in_array($action, $this->callMethods)) {
            throw new \Exception(sprintf("Method '%s' not found on the entity '%s'.", $name, get_called_class()));
        }

        $field = strtolower(preg_replace('/\B([A-Z])/', '_$1', substr($name, 3)));
        if (!in_array($field, $this->properties)) {
            throw new \Exception(sprintf("Property not found on the entity %s.", get_called_class()));
        }

        if ($action === 'get') {
            return $this->data[$field];
        }

        if ($action === 'set') {
            $this->data[$field] = $args[0];
        }
    }*/
}