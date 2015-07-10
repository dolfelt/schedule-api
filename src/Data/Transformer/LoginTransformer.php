<?php
namespace App\Data\Transformer;

use App\Data\Entity\Login;
use App\Data\Transformer;

class LoginTransformer extends Transformer
{
    public function __invoke(Login $entity)
    {
        return [
            'id'          => (int) $entity->getId(),
            'first_name'  => $entity->getFirstName(),
            'last_name'   => $entity->getLastName(),
            'email'       => $entity->getEmail(),
            'password'    => $entity->hasPassword(),
        ] + $this->getDefaults($entity);
    }
}