<?php
namespace Laventure\Component\Security\User\Password;


use Laventure\Component\Security\Encoder\Password\PasswordEncoder;
use Laventure\Component\Security\Encoder\PasswordEncoderInterface;
use Laventure\Component\Security\User\UserInterface;
use Laventure\Component\Security\User\UserPasswordEncoderInterface;


/**
 * @UserPasswordEncoder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\User\Password
*/
class UserPasswordEncoder implements UserPasswordEncoderInterface
{


    /**
     * @var PasswordEncoderInterface
    */
    protected PasswordEncoderInterface $encoder;


    /**
     * @param PasswordEncoderInterface|null $encoder
    */
    public function __construct(PasswordEncoderInterface $encoder = null)
    {
         $this->encoder = $encoder ?: new PasswordEncoder();
    }




    /**
     * @inheritDoc
    */
    public function encodePassword(UserInterface $user, string $plainPassword): string
    {
        return $this->encoder->encodePassword($plainPassword, $user->getSalt());
    }





    /**
     * @inheritDoc
    */
    public function isPasswordValid(UserInterface $user, string $plainPassword): bool
    {
         return $this->encoder->isPasswordValid($plainPassword, $user->getPassword());
    }



    /**
     * @inheritDoc
    */
    public function needsRehash(UserInterface $user)
    {
        return $this->encoder->needsRehash($user->getPassword());
    }
}