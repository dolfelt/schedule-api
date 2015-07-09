<?php
namespace App\Data;

class Paginate
{

    public static $defaultOptions = [
        'limit' => 20,
        'page'  => 0,
    ];

    protected $options;

    protected $total;
    protected $count;

    public function __construct(array $options = [])
    {
        $this->options = $options + static::$defaultOptions;
    }

    public function process(\SelectQuery $query)
    {
        $result = $query
            ->limit($this->options['limit'])
            ->offset($this->options['page']*$this->options['limit'])
            ->fetchAll();

        $this->count = count($result);

        // Check to see if total is equal to our limit and check for the real total
        if ($this->options['page'] || $this->count == $this->options['limit']) {
            $this->total = (int)$query->limit(null)->offset(null)->select(null)->select('COUNT(*)')->fetchColumn();
        } else {
            $this->total = $this->count;
        }

        return $result;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function getMeta()
    {
        return [
            'total' => $this->getTotal(),
            'count' => $this->getCount(),
            'limit' => (int) $this->options['limit'],
            'page'  => (int) $this->options['page'],
        ];
    }

}