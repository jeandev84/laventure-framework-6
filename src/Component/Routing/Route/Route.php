<?php
namespace Laventure\Component\Routing\Route;


use Laventure\Component\Routing\Route\Contract\MatchedRouteInterface;
use Laventure\Component\Routing\Route\Contract\NamedRouteInterface;
use Laventure\Component\Routing\Route\Contract\RouteInterface;


/**
 * @Route
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Route
*/
class Route implements NamedRouteInterface, MatchedRouteInterface, \ArrayAccess
{


    /**
     * Route domain
     *
     * @var  string
     */
    protected $domain;





    /**
     * Route methods
     *
     * @var array
     */
    protected $methods = [];





    /**
     * Route path
     *
     * @var string
     */
    protected $path;




    /**
     * Route pattern
     *
     * @var string
    */
    protected $pattern;





    /**
     * Route handler.
     *
     * @var mixed
    */
    protected $handler;





    /**
     * Route controller and action
     *
     * @var array
    */
    protected $controller = [
        "class"  => "",
        "action" => ""
    ];





    /**
     * Route name
     *
     * @var string
    */
    protected $name;





    /**
     * Route params
     *
     * @var array
    */
    protected $params = [];




    /**
     * Route middlewares
     *
     * @var array
    */
    protected $middlewares = [];




    /**
     * Route patterns
     *
     * @var array
    */
    protected $patterns = [];





    /**
     * Route options
     *
     * @var array
    */
    protected $options = [];





    /**
     * @param $methods
     *
     * @param $path
     *
     * @param $action
    */
    public function __construct($methods, $path, $action)
    {
         $this->methods($methods);
         $this->path($path);
         $this->action($action);
    }





    /**
     * Set domain
     *
     * @param string $domain
     *
     * @return $this
    */
    public function domain(string $domain): static
    {
        $this->domain = $domain;

        return $this;
    }




    /**
     * Set route methods
     *
     * @param array $methods
     * @return $this
    */
    public function methods(array $methods): static
    {
        $this->methods[] = $methods;

        return $this;
    }





    /**
     * Set route path
     *
     * @param string $path
     *
     * @return $this
    */
    public function path(string $path): static
    {
        $this->path = $path ?: '/';

        $this->pattern($this->path);

        return $this;
    }




    /**
     * Set route pattern
     *
     * @param string $pattern
     *
     * @return $this
    */
    public function pattern(string $pattern): static
    {
        $this->pattern = $pattern;

        return $this;
    }





    /**
     * Set route action
     *
     * @param callable $handler
     *
     * @return $this
    */
    public function action($handler): static
    {
        if (is_array($handler) and count($handler) === 2) {
            $this->controller($handler[0], $handler[1]);
        }

        $this->handler = $handler;

        return $this;
    }



    /**
     * @param string $name
     *
     * @return $this
    */
    public function name(string $name): static
    {
         $this->name .= $name;

         return $this;
    }




    /**
     * Set route pattern
     *
     * @param string $name
     *
     * @param string $pattern
     *
     * @return $this
    */
    public function where(string $name, string $pattern): static
    {
        $this->pattern($this->replacePlaceholders($name, $pattern));

        $this->patterns[$name] = $pattern;

        return $this;
    }







    /**
     * Set controller and action
     *
     * @param string $controller
     *
     * @param string $action
     *
     * @return $this
    */
    public function controller(string $class, string $action): static
    {
          $this->controller = compact('class', 'action');

          return $this;
    }




    /**
     * @inheritDoc
    */
    public function getDomain(): string
    {
        return $this->domain;
    }




    /**
     * @param string $separator
     * @return string
    */
    public function getMethodsAsString(string $separator = '|'): string
    {
         return join($separator, $this->methods);
    }




    /**
     * @inheritDoc
    */
    public function getMethods(): array
    {
        return $this->methods;
    }




    /**
     * @inheritDoc
    */
    public function getPath(): string
    {
        return $this->path;
    }




    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return $this->name;
    }




    /**
     * @inheritDoc
    */
    public function getHandler(): mixed
    {
        return $this->handler;
    }





    /**
     * @inheritDoc
    */
    public function getPattern(): string
    {
        return $this->pattern;
    }




    /**
     * @inheritDoc
    */
    public function getParams(): array
    {
        return $this->params;
    }




    /**
     * @inheritDoc
    */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }



    /**
     * @inheritDoc
    */
    public function getOptions(): array
    {
        return $this->options;
    }



    /**
     * @inheritDoc
    */
    public function match(string $requestMethod, string $requestUri): bool
    {

    }





    /**
     * @return bool
    */
    public function hasName(): bool
    {
        return ! empty($this->name);
    }




    /**
     * @return bool
    */
    public function hasController(): bool
    {
         return ! empty($this->controller['class']);
    }



    /**
     * @return string
    */
    public function getController(): string
    {
         return $this->controller['class'];
    }




    /**
     * Determine if route handler is callable
     *
     * @return bool
     */
    public function callable(): bool
    {
        return is_callable($this->handler);
    }




    /**
     * @return false|void
    */
    public function call()
    {
        if (! $this->callable()) {
            return false;
        }

        call_user_func_array($this->getHandler(), array_values($this->params));
    }





    /**
     * @inheritDoc
     */
    public function offsetExists(mixed $offset)
    {
        return property_exists($this, $offset);
    }



    /**
     * @inheritDoc
     */
    public function offsetGet(mixed $offset)
    {
        if (! $this->offsetExists($offset)) {
            return false;
        }

        return $this->{$offset};
    }




    /**
     * @inheritDoc
    */
    public function offsetSet(mixed $offset, mixed $value)
    {
        if ($this->offsetExists($offset)) {
            $this->{$offset} = $value;
        }
    }




    /**
     * @inheritDoc
    */
    public function offsetUnset(mixed $offset)
    {
        if ($this->offsetExists($offset)) {
            unset($this->{$offset});
        }
    }





    /**
     * @param string $pattern
     * @return string
    */
    private function resolvePattern(string $pattern): string
    {
        return str_replace('(', '(?:', $pattern);
    }




    /**
     * @param string $name
     *
     * @return string[]
    */
    private function getNamePlaceholders(string $name): array
    {
         return ["#{{$name}}#", "#{{$name}.?}#"];
    }





    /**
     * @param string $pattern
     * @return string[]
    */
    private function getReplacedPatterns(string $pattern): array
    {
        return [$pattern, '?'. $pattern .'?'];
    }




    /**
     * @param string $name
     *
     * @param string $pattern
     *
     * @return string
    */
    private function replacePlaceholders(string $name, string $pattern): string
    {
         $pattern  = $this->resolvePattern($pattern);
         $search  = $this->getNamePlaceholders($name);
         $replace = $this->getReplacedPatterns(sprintf('(?P<%s>%s)', $name, $pattern));

         return preg_replace($search, $replace, $this->pattern);
    }
}