<?php
namespace Laventure\Foundation\Security\Provider;

use Laventure\Component\Security\User\Provider\UserProviderInterface;
use Laventure\Component\Security\User\Token\UserTokenInterface;
use Laventure\Component\Security\User\UserInterface;


/**
 * @UserProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Foundation\Security\Provider
*/
class UserProvider implements UserProviderInterface
{

    /**
     * @inheritDoc
    */
    public function findById(int $id): ?UserInterface
    {
        $user = new \App\Entity\User\User($id);
        $user->setEmail('jeanyao@ymail.com');
        $user->setUsername('brown');

        return $user;
    }




    /**
     * @inheritDoc
    */
    public function findByUsername(string $username): ?UserInterface
    {
        $user = new \App\Entity\User\User(3);
        $user->setEmail($username);
        $user->setUsername($username);
        $user->setRoles([
            "ROLE_ADMIN",
            "ROLE_USER"
        ]);

        return $user;
    }



    /**
     * @inheritDoc
     */
    public function updatePasswordHash(UserInterface $user, string $hash)
    {
        // TODO: Implement updateUserPasswordHash() method.
    }




    /**
     * @inheritDoc
    */
    public function findByRememberIdentifier($identifier): ?UserInterface
    {
        // TODO: Implement getByRememberIdentifier() method.
    }




    /**
     * @inheritDoc
    */
    public function removeRememberToken(UserInterface $user)
    {
        // TODO: Implement removeRememberToken() method.
    }




    /**
     * @inheritDoc
    */
    public function updateRememberToken(UserInterface $user, string $hash)
    {
        // TODO: Implement updateRememberToken() method.
    }



    /**
     * @inheritDoc
    */
    public function getToken(): UserTokenInterface
    {
        // TODO: Implement getToken() method.
    }




    /**
     * @inheritDoc
    */
    public function createToken(UserInterface $user): UserTokenInterface
    {
        // TODO: Implement createToken() method.
    }





    /**
     * @inheritDoc
    */
    public function createRememberToken(UserInterface $user): static
    {
        // TODO: Implement createRememberToken() method.
    }



    /**
     * @inheritDoc
    */
    public function removeToken(UserInterface $user): bool
    {
        // TODO: Implement removeToken() method.
    }



    /**
     * @inheritDoc
    */
    public function hasRememberToken(): bool
    {
        // TODO: Implement hasRememberToken() method.
    }




    /**
     * @inheritDoc
    */
    public function hasToken(): bool
    {
        // TODO: Implement hasToken() method.
    }
}