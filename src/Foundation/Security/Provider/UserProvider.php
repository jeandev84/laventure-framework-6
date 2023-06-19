<?php
namespace Laventure\Foundation\Security\Provider;

use Laventure\Component\Http\Storage\Session\SessionInterface;
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
     * @var SessionInterface
    */
    protected SessionInterface $session;



    /**
     * @var string
    */
    protected string $entityName;



    /**
     * @param SessionInterface $session
     *
     * @param string $entityName
    */
    public function __construct(SessionInterface $session, string $entityName)
    {
        $this->session    = $session;
        $this->entityName = $entityName;
    }




    /**
     * @inheritDoc
     */
    public function getById(int $id): ?UserInterface
    {
        // TODO: Implement getById() method.
    }

    /**
     * @inheritDoc
     */
    public function getByUsername(string $username): ?UserInterface
    {
        // TODO: Implement getByUsername() method.
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
    public function getByRememberIdentifier($identifier): ?UserInterface
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