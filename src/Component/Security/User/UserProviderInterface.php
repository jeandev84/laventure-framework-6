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
      * @return mixed
     */
     public function findByRememberIdentifier($identifier);






     /**
      * @param int $id
      *
      * @return mixed
     */
     public function clearRememberToken(int $id);






     /**
      * @param int $id
      *
      * @param string $hash
      *
      * @return mixed
     */
     public function updateRememberToken(int $id, string $hash);
}