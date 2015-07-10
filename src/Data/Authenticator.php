<?php
namespace App\Data;

use App\Data\Entity\Login;
use App\Data\Entity\User;
use App\Data\Mapper\LoginMapper;
use App\Data\Mapper\UserMapper;
use Carbon\Carbon;
use Spark\Auth\AbstractAuthenticator;
use Psr\Http\Message\ServerRequestInterface as Request;

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

    public function getToken(Request $request)
    {
        return current($request->getHeader('Authorization'));
    }

    public function isValid($token)
    {
        $data = $this->parseToken($token);

        if (!$data) {
            return false;
        }

        return true;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function authenticate(Login $login, $password)
    {
        return $this->generateToken($login);
    }

    protected function parseToken($token)
    {
        $data = \JWT::decode($token, $this->secret, ['HS256']);

        if ($data && !empty($data->login_id)) {
            $this->login = $this->mapper->getLoginById($data->login_id);
        }

        return $data;
    }

    public function generateToken(Login $login)
    {
        $token = [
            "iss"            => "http://api.example.com/v1",
            "aud"            => "http://api.example.com/v1",
            "iat"            => Carbon::now()->getTimestamp(),
            "login_id"       => $login->getId(),
            "application_id" => 0,
        ];

        return \JWT::encode($token, $this->secret, 'HS256');
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