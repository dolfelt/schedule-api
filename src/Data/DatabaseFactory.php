<?php
namespace App\Data;

use LessQL\Database;

class DatabaseFactory
{

    /**
     * @param $config Configuration for connection
     * @return Database
     */
    public static function connect(array $config = null)
    {
        $pdo = new \PDO( 'sqlite:../data/schedule.sqlite3' );
        $db = new Database( $pdo );
        static::setup($db);

        return $db;
    }

    private static function setup(Database $db)
    {
        // TODO: Add custom mapping functions and aliases
    }

}