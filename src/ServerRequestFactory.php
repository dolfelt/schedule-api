<?php
namespace App;

class ServerRequestFactory extends \Zend\Diactoros\ServerRequestFactory
{

    public function __invoke()
    {
        $body = json_decode(file_get_contents('php://input'), true);
        return parent::fromGlobals(
            null,
            null,
            $body,
            null,
            null
        );
    }
}