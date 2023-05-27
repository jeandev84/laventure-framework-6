<?php
namespace Laventure\Component\Routing\Generator;

use Laventure\Component\Routing\RouterInterface;


/**
 * @UrlGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Generator
*/
class UrlGenerator implements UrlGeneratorInterface
{

    /**
     * @param RouterInterface $router
     *
     * @param array $queries [ previous queries params from url ]
    */
    public function __construct(protected RouterInterface $router, protected array $queries = [])
    {

    }



    /**
     * @inheritDoc
    */
    public function generateUrl(string $name, array $parameters = [], array $queries = [], string $fragment = null)
    {
        return sprintf('%s%s', $this->router->getDomain(), $this->generateURI($name, $parameters, $queries, $fragment));
    }




    /**
     * @inheritDoc
    */
    public function generateURI(string $name, array $parameters = [], array $queries = [], string $fragment = null)
    {
         if (! $path = $this->router->generate($name, $parameters)) {
              return $this->generateNativePath($name, $queries, $fragment);
         }

        return $this->generateNativePath($path, $queries, $fragment);
    }




    /**
     * @param string $path
     *
     * @param array $queries
     *
     * @param string $fragment
     *
     * @return string
    */
    private function generateNativePath(string $path, array $queries, string $fragment): string
    {
        $queries = array_merge($this->queries, $queries);

        return sprintf('%s%s%s', $path, http_build_query($queries), $fragment);
    }
}