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
     * @var string
    */
    protected $name;



    /**
     * @var array
    */
    protected $algos = [
        'default' => PASSWORD_DEFAULT,
        'bcrypt'  => PASSWORD_BCRYPT
    ];




    /**
     * @var array
    */
    protected $options = [];




    /**
     * @param string $algo
    */
    public function __construct(string $algo = 'default')
    {
         $this->algo($algo);
    }





    /**
     * @param string $name
     *
     * @return $this
    */
    public function algo(string $name): static
    {
        if (! array_key_exists($name, $this->algos)) {
            throw new InvalidPasswordAlgoException($name);
        }

        $this->algo = $this->algos[$name];
        $this->name = $name;

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

         if(! $hash = password_hash($plainPassword, $this->algo, $this->options)) {
              throw new \RuntimeException(ucfirst($this->name) . " not supported.");
         }

         return $hash;
    }






    /**
     * @inheritDoc
    */
    public function isPasswordValid(string $plainPassword, string $hash): bool
    {
        return password_verify($plainPassword, $hash);
    }




    /**
     * @inheritDoc
    */
    public function needsRehash(string $hash): bool
    {
        return password_needs_rehash($hash, $this->algo, $this->options);
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
     * @return $this
    */
    public function removeOption(string $name): static
    {
         unset($this->options[$name]);

         return $this;
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
}