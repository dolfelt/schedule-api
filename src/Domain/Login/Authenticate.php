<?php
namespace App\Domain\Login;

use App\Data\Authenticator;
use App\Data\Mapper\LoginMapper;
use App\Data\Mapper\UserMapper;
use Aura\Payload\Payload;
use Spark\Adr\DomainInterface;

class Authenticate implements DomainInterface
{

    protected $userMapper;
    protected $loginMapper;
    protected $auth;

    public function __construct(UserMapper $userMapper, LoginMapper $loginMapper, Authenticator $auth)
    {
        $this->userMapper  = $userMapper;
        $this->loginMapper = $loginMapper;
        $this->auth        = $auth;
    }

    public function __invoke(array $input)
    {
        $payload = new Payload();
        if (empty($input['email']) || empty($input['password'])) {
            $payload->setStatus(Payload::FAILURE);
            return $payload->setInput(['error' => 'Please include both email and password fields.']);
        }

        $email = $input['email'];
        $password = $input['password'];

        $login = $this->loginMapper->getLoginByEmail($email);

        if (!$login) {
            $payload->setStatus(Payload::NOT_ACCEPTED);
            return $payload->setInput(['error' => 'Cannot find a user with that email address or password.']);
        }

        $token = $this->auth->authenticate($login, $password);

        // Password validation failed
        if (!$token) {
            $payload->setStatus(Payload::FAILURE);
            return $payload->setInput(['error' => 'No user with that email address or password.']);
        }

        $payload->setStatus(Payload::FOUND);
        return $payload->setOutput([
            'login' => $login,
            'token' => $token,
        ]);

    }
}