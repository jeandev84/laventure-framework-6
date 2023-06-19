<?php
namespace Laventure\Component\Security\User;

interface UserManagerInterface
{

    /**
     * @return UserTokenInterface|null
    */
    public function getUserToken(): ?UserTokenInterface;



    /**
     * @return bool
    */
    public function hasUserToken(): bool;





    /**
     * @param UserInterface $user
     *
     * @return UserTokenInterface
    */
    public function createUserToken(UserInterface $user): UserTokenInterface;



    /**
     * @param bool $rememberMe
     *
     * @return mixed
    */
    public function rememberMe(bool $rememberMe);




    /**
     * @param string $plainPassword
     *
     * @return string
    */
    public function cryptPassword(string $plainPassword): string;




    /**
     * @param UserInterface $user
     *
     * @param string $plainPassword
     *
     * @return bool
    */
    public function isPasswordValid(UserInterface $user, string $plainPassword): bool;




    /**
     * @return mixed
    */
    public function logout();
}