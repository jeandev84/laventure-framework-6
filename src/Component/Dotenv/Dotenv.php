<?php
namespace Laventure\Component\Dotenv;


/**
 * @Dotenv
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Dotenv
 */
class Dotenv
{

    /**
     * @var string
    */
    private $root;



    /**
     * @param string $root
    */
    public function __construct(string $root)
    {
        $this->root = $root;
    }


    /**
     * @param string $filename
     * @return void
     */
    public function load(string $filename = '.env'): void
    {
        foreach ($this->loadEnvironments($filename) as $env) {
            $this->put($env);
        }
    }


    /**
     * @param string $filename
     * @return bool
     */
    public function export(string $filename = '.env.local'): bool
    {
        if (! touch($filename = $this->locateEnvironmentFile($filename))) {
            return false;
        }

        if ($filename = realpath($filename)) {
            file_put_contents($filename, "");
            foreach ($_ENV as $name => $value) {
                if (is_string($value)) {
                    file_put_contents($filename, "$name=$value". PHP_EOL, FILE_APPEND);
                }
            }
        }

        return true;
    }



    /**
     * @param string $filename
     * @return array
    */
    private function loadEnvironments(string $filename): array
    {
        if(! $filename = realpath($this->locateEnvironmentFile($filename))){
            return [];
        }

        if(! $params = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)) {
            return [];
        }

        return array_filter($params, function ($value) {
            return stripos($value, '#') === false;
        });
    }



    /**
     * @param string $env
     *
     * @return $this
    */
    public function put(string $env): static
    {
        if (preg_match('#^(?=[A-Z])(.*)=(.*)$#', $env, $matches)) {

            putenv($env);

            [$key, $value] = $this->resolveParams($matches);

            $_SERVER[$key] = $_ENV[$key] = $value;
        }

        return $this;
    }




    /**
     * @param string $filename
     * @return string
    */
    private function locateEnvironmentFile(string $filename): string
    {
        return $this->root . DIRECTORY_SEPARATOR . trim($filename, DIRECTORY_SEPARATOR);
    }




    /**
     * @param array $matches
     *
     * @return string[]
    */
    private function resolveParams(array $matches): array
    {
        $parameters = str_replace(' ', '', trim($matches[0]));

        return explode("=", $parameters, 2);
    }
}