<?php
namespace Laventure\Component\Security\User\Token;

use Laventure\Component\Security\User\UserInterface;

/**
 * @UserTokenInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\User\Token
*/
class UserToken implements UserTokenInterface
{

    /**
     * @var UserInterface
    */
    protected UserInterface $user;



    /**
     * @param UserInterface $user
    */
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }




    /**
     * @inheritDoc
    */
    public function getUser(): UserInterface
    {
        return $this->user;
    }


    /**
     * @inheritDoc
    */
    public function serialize(): string
    {
        return serialize($this);
    }
}