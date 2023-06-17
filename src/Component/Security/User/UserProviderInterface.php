<?php
namespace Laventure\Component\Security\User;

/**
 * @UserProviderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\User
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
      * @return mixed
     */
     public function updatePasswordHash(UserInterface $user, string $hash);




     /**
      * @param $identifier
      *
      * @return mixed
     */
     public function findByRememberIdentifier($identifier);




     /**
      * @param $id
      *
      * @return mixed
     */
     public function clearRememberToken($id);





    /**
     * @param $id
     *
     * @param string $identifier
     *
     * @param string $hash
     *
     * @return mixed
     */
     public function setUserRememberToken($id, string $identifier, string $hash);
}