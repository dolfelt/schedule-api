<?php
namespace App\Data;

class DatabaseFactory
{

    /**
     * @param $config Configuration for connection
     * @return \FluentPDO
     */
    public static function connect(array $config)
    {
        extract($config);
        $pdo = new PDO( $dsn, $user, $pass );
        return new \FluentPDO($pdo);
    }

}