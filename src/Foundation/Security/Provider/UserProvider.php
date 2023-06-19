<?php
namespace Laventure\Foundation\Security\Provider;

use Laventure\Component\Http\Storage\Session\SessionInterface;
use Laventure\Component\Security\User\Provider\UserProviderInterface;
use Laventure\Component\Security\User\UserInterface;


class UserProvider implements UserProviderInterface
{

    /**
     * @var SessionInterface
    */
    protected SessionInterface $session;



    /**
     * @param SessionInterface $session
    */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }




    /**
     * @inheritDoc
    */
    public function findById(int $id): ?UserInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function findByUsername(string $username): ?UserInterface
    {

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
    public function findByRememberIdentifier($identifier): ?UserInterface
    {
        // TODO: Implement findByRememberIdentifier() method.
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
    public function hasRememberToken(): bool
    {
        // TODO: Implement hasRememberToken() method.
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
}