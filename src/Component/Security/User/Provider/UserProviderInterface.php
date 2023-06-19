<?php
namespace Laventure\Component\Security\User\Provider;

use Laventure\Component\Security\User\Token\UserTokenInterface;
use Laventure\Component\Security\User\UserInterface;

/**
 * @UserProviderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\User\Provider
*/
interface UserProviderInterface
{

     /**
      * @param int $id
      *
      * @return UserInterface|null
     */
     public function findById(int $id): ?UserInterface;





     /**
      * Returns user
      *
      * @param string $username
      *
      * @return UserInterface|null
     */
     public function findByUsername(string $username): ?UserInterface;




     /**
      * @param UserInterface $user
      *
      * @param string $hash
      *
      * @return mixed
     */
     public function updateUserPasswordHash(UserInterface $user, string $hash);





     /**
      * @param $identifier
      *
      * @return UserInterface|null
     */
     public function findByRememberIdentifier($identifier): ?UserInterface;




     /**
      * @return mixed
     */
     public function removeRememberToken(UserInterface $user);

     


     /**
      * @param UserInterface $user
      *
      * @param string $hash
      *
      * @return mixed
     */
     public function updateRememberToken(UserInterface $user, string $hash);





     /**
      * @return bool
     */
     public function hasRememberToken(): bool;




    /**
     * Returns user from the session
     *
     * @return UserTokenInterface
    */
    public function getToken(): UserTokenInterface;





    /**
     * @param UserInterface $user
     * @return UserTokenInterface
    */
    public function createToken(UserInterface $user): UserTokenInterface;



    


    /**
     * Save user token in cookie
     *
     * @param UserInterface $user
     *
     * @return $this
    */
    public function createRememberToken(UserInterface $user): static;






    /**
     * @param UserInterface $user
     *
     * @return bool
    */
    public function removeToken(UserInterface $user): bool;
}