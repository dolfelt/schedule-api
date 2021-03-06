<?php
namespace App\Data;

use App\Data\Entity\Login;
use App\Data\Mapper\LoginMapper;
use App\Data\Mapper\UserMapper;
use Spark\Auth\AbstractAuthenticator;
use Psr\Http\Message\RequestInterface as Request;
use JWT;
use Spark\Auth\Exception\AuthException;

class Authenticator extends AbstractAuthenticator
{
    /**
     * @var Login
     */
    protected $login;

    /**
     * @var LoginMapper
     */
    protected $mapper;

    /**
     * @var UserMapper
     */
    protected $userMapper;

    protected $secret;

    public function __construct(LoginMapper $mapper, UserMapper $userMapper)
    {
        $this->mapper = $mapper;
        $this->userMapper = $userMapper;
        $this->secret = $_ENV['JWT_SECRET'];
    }

    public function getTokenFromRequest(Request $request)
    {
        return current($request->getHeader('Authorization'));
    }

    public function isValid()
    {
        $data = $this->parseToken($this->getToken());

        if (!$data) {
            return false;
        }

        return true;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function ensureLogin()
    {
        if (!$this->getLogin()) {
            throw new AuthException("This method requires that you are logged in.");
        }
    }

    public function authenticate(Login $login, $password)
    {
        if (!static::validatePassword($password, $login->getPasswordHash())) {
            return null;
        }
        return $this->generateToken($login);
    }

    protected function parseToken($token)
    {
        $data = JWT::decode($token, $this->secret, ['HS256']);

        if ($data && !empty($data->login_id) && !$this->login) {
            $this->login = $this->mapper->getLoginById($data->login_id);
        }

        return $data;
    }

    public function generateToken(Login $login)
    {
        $token = [
            "iss"            => "http://api.example.com/v1",
            "aud"            => "http://api.example.com/v1",
            "iat"            => time(),
            "login_id"       => $login->getId(),
            "application_id" => 0,
        ];

        return JWT::encode($token, $this->secret, 'HS256');
    }

    public static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function validatePassword($password, $hash)
    {
        return password_verify($password, $hash);
    }
}