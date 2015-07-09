<?php
namespace App;

use Auryn\Injector;
use App\Data\DatabaseFactory;

class Bootstrap
{
    protected $injector;

    protected $config;

    public function __construct(Injector $injector)
    {
        $this->injector = $injector;
    }

    public function boot()
    {
        $this->setupDatabase();
    }

    protected function setupDatabase()
    {
        $config = [
            'dsn' => $_ENV['PDO_DSN'],
            'user' => $_ENV['PDO_USER'],
            'pass' => $_ENV['PDO_PASS']
        ];
        $database = DatabaseFactory::connect($config);
        $this->injector->share($database);

    }

}