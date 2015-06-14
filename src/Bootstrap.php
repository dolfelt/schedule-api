<?php
namespace App;

use Auryn\Injector;
use App\Data\DatabaseFactory;

class Bootstrap
{
    protected $injector;

    public function __construct()
    {
        $this->injector = new Injector;

        // Setup dependencies for the application

        $this->setupDatabase();
    }

    protected function setupDatabase()
    {
        $database = DatabaseFactory::connect();
        $this->injector->share($database);

        foreach ($this->getMappers() as $mapper) {
            $this->injector->share('/App/Data/Mapper/' . $mapper);
        }
    }

    protected function getMappers()
    {
        return [
            'ShiftMapper',
        ];
    }

    /**
     * Get the injector for the application.
     *
     * @return Injector
     */
    public function getInjector()
    {
        return $this->injector;
    }

}