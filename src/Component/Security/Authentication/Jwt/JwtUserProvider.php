<?php
namespace Laventure\Component\Security\Authentication\Jwt;

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

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?UserInterface
    {
        // TODO: Implement findById() method.
    }

    /**
     * @inheritDoc
     */
    public function updateUserPasswordHash(int $id, string $hash)
    {
        // TODO: Implement updatePasswordHash() method.
    }

    /**
     * @inheritDoc
     */
    public function findByRememberIdentifier($identifier)
    {
        // TODO: Implement findByRememberIdentifier() method.
    }

    /**
     * @inheritDoc
     */
    public function clearRememberToken($id)
    {
        // TODO: Implement clearRememberToken() method.
    }

    /**
     * @inheritDoc
     */
    public function setUserRememberToken($id, string $identifier, string $hash)
    {
        // TODO: Implement setUserRememberToken() method.
    }
}