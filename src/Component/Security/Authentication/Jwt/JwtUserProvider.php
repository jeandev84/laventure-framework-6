<?php
namespace Laventure\Component\Security\Jwt;

use Laventure\Component\Security\User\UserInterface;
use Laventure\Component\Security\User\UserProviderInterface;

class JwtUserProvider implements UserProviderInterface
{

    /**
     * @inheritDoc
    */
    public function findByUsername(string $username): ?UserInterface
    {
        // TODO: Implement findByUsername() method.
    }
}