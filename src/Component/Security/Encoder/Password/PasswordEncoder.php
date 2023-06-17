<?php
namespace Laventure\Component\Security\Encoder\Password;

use Laventure\Component\Security\Encoder\PasswordEncoderInterface;


class PasswordEncoder implements PasswordEncoderInterface
{


    /**
     * @var string
    */
    protected $algo;



    /**
     * @var array
    */
    protected $options = [];



    /**
     * @param string $algo
     *
     * @param int $cost
    */
    public function __construct(string $algo = 'default', int $cost = 0)
    {
         $this->algo($algo);
         $this->cost($cost);
    }





    /**
     * @param string $algo
     *
     * @return $this
    */
    public function algo(string $algo): static
    {
        $this->algo = $this->resolvePasswordAlgo($algo);

        return $this;
    }





    /**
     * @param int $cost
     *
     * @return $this
    */
    public function cost(int $cost): static
    {
         return $this->options(compact('cost'));
    }





    /**
     * @param array $options
     *
     * @return $this
    */
    public function options(array $options): static
    {
        $this->options = array_merge($this->options, $options);

        return $this;
    }




    /**
     * @param string $salt
     *
     * @return $this
    */
    public function salt(string $salt): static
    {
        return $this->options(compact('salt'));
    }






    /**
     * @inheritDoc
    */
    public function encodePassword(string $plainPassword, string $salt = null): string
    {
         $this->salt($salt ?: '');

         return password_hash($plainPassword, $this->algo, $this->options);
    }





    /**
     * @inheritDoc
     */
    public function isPasswordValid(string $plainPassword, string $hash): bool
    {
        return password_verify($plainPassword, $hash);
    }





    /**
     * @inheritdoc
    */
    public function getAlgo(): string
    {
         return $this->algo;
    }




    /**
     * @param string $name
     *
     * @param $default
     *
     * @return mixed|null
    */
    public function getOption(string $name, $default = null): mixed
    {
        return $this->options[$name] ?? $default;
    }




    /**
     * @param string $name
     *
     * @return void
    */
    public function removeOption(string $name)
    {
         unset($this->options[$name]);
    }




    /**
      * @return int
    */
    public function getCost(): int
    {
        return $this->getOption('cost', 0);
    }




    /**
     * @return string
    */
    public function getSalt(): string
    {
        return $this->getOption('salt', '');
    }




    /**
     * @return array
    */
    public function getOptions(): array
    {
        return $this->options;
    }




    /**
     * @param string $name
     *
     * @return mixed
     *
     * @throws InvalidPasswordAlgoException
    */
    private function resolvePasswordAlgo(string $name): mixed
    {
        return [
           'default' => PASSWORD_DEFAULT,
           'bcrypt'  => PASSWORD_BCRYPT
        ][$name] ?? throw new InvalidPasswordAlgoException($name);
    }
}