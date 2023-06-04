<?php
namespace Laventure\Component\Security\Authentication\User;


class NativeUser implements UserInterface
{
    /**
     * @var int|null
     */
    protected ?int $id;




    /**
     * @var string|null
    */
    protected ?string $username;



    /**
     * @var string|null
    */
    protected ?string $email;




    /**
     * @var string|null
    */
    protected ?string $password;



    /**
     * @var array
    */
    protected array $roles;




    /**
     * @param array $roles
    */
    public function __construct(array $roles = [])
    {
        $this->roles = $roles;
    }




    /**
     * @param string|null $email
     *
     * @return $this
    */
    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }




    /**
     * @param string|null $username
     *
     * @return $this
    */
    public function setUsername(?string $username): static
    {
        $this->username = $username;

        return $this;
    }




    /**
     * @param string|null $password
     *
     * @return $this
    */
    public function setPassword(?string $password): static
    {
        $this->password = $password;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getUsername(): ?string
    {
        return $this->username;
    }




    /**
     * @inheritDoc
    */
    public function getPassword(): ?string
    {
       return $this->password;
    }




    /**
     * @inheritDoc
    */
    public function getRoles(): array
    {
        $roles = [self::ROLE_USER];

        $this->addRole($roles);

        return $this->roles;
    }




    /**
     * @inheritDoc
     */
    public function getSalt(): string
    {
        return sha1(uniqid($this->getUsername()));
    }



    /**
     * @param array $roles
     *
     * @return $this
    */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }




    /**
     * @param $role
     *
     * @return $this
    */
    public function addRole($role): static
    {
        $this->roles = array_merge($this->roles, (array)$role);

        return $this;
    }
}