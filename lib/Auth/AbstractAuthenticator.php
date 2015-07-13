<?php
namespace Spark\Auth;

use Psr\Http\Message\ServerRequestInterface as Request;
use Spark\Auth\Exception\InvalidException;

abstract class AbstractAuthenticator
{
    protected $token;

    abstract public function getTokenFromRequest(Request $request);

    abstract public function isValid();

    public function parseRequest(Request $request)
    {
        $this->setToken( $this->getTokenFromRequest($request) );
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function ensureValid()
    {
        if ($this->getToken() && !$this->isValid()) {
            throw new InvalidException($this->getErrorMessage());
        }
    }

    public function getErrorMessage()
    {
        return 'The token in invalid';
    }
}