<?php
namespace App\Data;

abstract class Entity implements \JsonSerializable
{
    protected $properties = [];

    protected $id;

    private $data;

    private $callMethods = ['get', 'set'];

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function getId()
    {
        return $this->id;
    }

    public function mapData(array $row)
    {
        $this->data = $row;
    }

    public function jsonSerialize()
    {
        return $this->data;
    }

    public function __call($name, $args)
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
    }
}