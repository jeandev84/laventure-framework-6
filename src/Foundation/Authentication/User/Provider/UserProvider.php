<?php
namespace Laventure\Foundation\Authentication\User\Provider;

use App\Entity\User\User;
use Laventure\Component\Security\User\UserInterface;
use Laventure\Component\Security\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{

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
    public function findByUsername(string $username): ?UserInterface
    {
        $user = new User();
        $user->setEmail('jeanyao@ymail.com');
        $user->setPassword(password_hash('123', PASSWORD_DEFAULT));
        $user->setUsername('brown');
        $user->addRole(['ROLE_ADMIN']);
        return $user;
    }

    /**
     * @inheritDoc
     */
    public function updateUserPasswordHash(UserInterface $user, string $hash)
    {
        // TODO: Implement updateUserPasswordHash() method.
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
    public function clearRememberToken(int $id)
    {
        // TODO: Implement clearRememberToken() method.
    }

    /**
     * @inheritDoc
     */
    public function updateRememberToken(int $id, string $hash)
    {
        // TODO: Implement updateRememberToken() method.
    }
}