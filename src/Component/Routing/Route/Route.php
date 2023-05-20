<?php
namespace Laventure\Component\Routing\Route;


use ArrayAccess;
use Laventure\Component\Routing\Route\Collection\RouteCollection;
use Laventure\Component\Routing\Route\Contract\MatchedRouteInterface;
use Laventure\Component\Routing\Route\Contract\NamedRouteInterface;


/**
 * @Route
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Route
*/
class Route implements NamedRouteInterface, MatchedRouteInterface, ArrayAccess
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
    protected $callback;





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
     *
    */
    public function __construct($methods, $path, $action)
    {
         $this->methods($methods);
         $this->path($path);
         $this->callback($action);
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
        $this->domain = rtrim($domain, '\\/');

        return $this;
    }




    /**
     * Set route methods
     *
     * @param array|string $methods
     *
     * @return $this
    */
    public function methods(array|string $methods): static
    {
        $this->methods = $this->resolveMethods($methods);

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
        $this->pattern = $this->normalizePattern($pattern);

        return $this;
    }




    /**
     * @param callable $callback
     *
     * @return $this
    */
    public function callback($callback): static
    {
         $this->callback = $this->resolveCallback($callback);

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

         RouteCollection::$namedRoutes[$this->name] = $this;

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
     * @param string $name
     * @return $this
     */
    public function whereNumber(string $name): self
    {
        return $this->where($name, '\d+');
    }




    /**
     * @param string $name
     * @return $this
    */
    public function whereText(string $name): self
    {
        return $this->where($name, '\w+');
    }




    /**
     * @param string $name
     * @return $this
    */
    public function whereAlphaNumeric(string $name): self
    {
        return $this->where($name, '[^a-z_\-0-9]');
    }





    /**
     * @param string $name
     * @return $this
    */
    public function whereSlug(string $name): self
    {
        return $this->where($name, '[a-z\-0-9]+');
    }




    /**
     * @param string $name
     * @return $this
    */
    public function anything(string $name): self
    {
        return $this->where($name, '.*');
    }




    /**
     * @param array $patterns
     *
     * @return $this
    */
    public function wheres(array $patterns): static
    {
        foreach ($patterns as $name => $pattern) {
             $this->where($name, $pattern);
        }

        return $this;
    }





    /**
     * Route options
     *
     * @param array $options
     *
     * @return $this
    */
    public function options(array $options): static
    {
        foreach ($options as $name => $value) {
             $this->option($name, $value);
        }

        return $this;
    }






    /**
     * @param string $name
     *
     * @param $value
     *
     * @return $this
    */
    public function option(string $name, $value): static
    {
        $this->options[$name] = $value;

        return $this;
    }





    /**
     * Set controller class and action
     *
     * @param string $class
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
     * Add middlewares
     *
     * @param $middlewares
     *
     * @return $this
    */
    public function middleware($middlewares): static
    {
        $this->middlewares = array_merge($this->middlewares, (array) $middlewares);

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
    public function getName(): ?string
    {
        return $this->name;
    }




    /**
     * @inheritDoc
    */
    public function getCallback(): mixed
    {
        return $this->callback;
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
     * Determine if the given request method match route
     *
     * @param string $requestMethod
     *
     * @return bool
    */
    public function matchRequestMethod(string $requestMethod): bool
    {
         if(in_array($requestMethod, $this->methods)) {
              $this->options(compact('requestMethod'));
              return true;
         }

         return false;
    }




    /**
     * @param string $requestPath
     *
     * @return bool
    */
    public function matchRequestPath(string $requestPath): bool
    {
          $pattern =  $this->getPatternExpression();
          $path    =  $this->resolveRequestPath($requestPath);

          if (preg_match($pattern, $path, $matches)) {
              $this->params = $this->resolveParams($matches);
              $this->options([
                  'url'         => sprintf('%s%s', $this->domain, $requestPath),
                  'requestPath' => $requestPath,
                  'matches'     => $matches,
              ]);

              return true;
          }

          return false;
    }





    /**
     * @inheritDoc
    */
    public function match(string $requestMethod, string $requestPath): bool
    {
          return $this->matchRequestMethod($requestMethod) && $this->matchRequestPath($requestPath);
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
    public function isCallable(): bool
    {
        return is_callable($this->callback);
    }




    /**
     * @param array $params
     *
     * @return mixed
    */
    public function call(array $params = []): mixed
    {
        if (! $this->isCallable()) {
            return false;
        }

        return call_user_func_array($this->getCallback(), $this->getDependencies($params));
    }




    /**
     * Generate route from given params
     *
     * @param array $parameters
     *
     * @return string
    */
    public function uri(array $parameters = []): string
    {
        return $this->getPath();

        /*
        $path = $this->getPath();

        $path = '/admin/{id}/{name}';
        $r    = '/admin/1/something';

        foreach ($parameters as $name => $value) {
            $path = preg_replace($this->searchedPlaceholders($name), [$value, $value], $path);
        }

        # {id|name}, {value1, value2}
        return $path;
        */
    }




    /**
     * @return array
    */
    public function getValuesOfParams(): array
    {
         return array_values($this->getParams());
    }




    /**
     * @return string
    */
    private function getPatternExpression(): string
    {
        return "#^{$this->pattern}$#i";
    }




    /**
     * @param string $path
     *
     * @return string
    */
    private function resolveRequestPath(string $path): string
    {
        return '/'. parse_url(trim($path, '\\/'), PHP_URL_PATH);
    }




    /**
     * @param array $matches
     * @return array
    */
    private function resolveParams(array $matches): array
    {
        return array_filter($matches, function ($key) {
            return ! is_numeric($key);
        }, ARRAY_FILTER_USE_KEY);
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
    private function searchedPlaceholders(string $name): array
    {
         return ["#{{$name}}#", "#{{$name}.?}#"];
    }





    /**
     * @param string $pattern
     * @return string[]
    */
    private function replacedPatterns(string $pattern): array
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
         $pattern = $this->resolvePattern($pattern);
         $search  = $this->searchedPlaceholders($name);
         $replace = $this->replacedPatterns(sprintf('(?P<%s>%s)', $name, $pattern));

         return preg_replace($search, $replace, $this->pattern);
    }




    /**
     * @param string $pattern
     *
     * @return string
    */
    private function normalizePattern(string $pattern): string
    {
        return '/'. trim($pattern, '\\/');
    }





    /**
     * @param $callback
     *
     * @return mixed
    */
    private function resolveCallback($callback): mixed
    {
        if (is_array($callback)) {
            $this->controller((string)$callback[0] ?? '', (string)$callback[1] ?? '');
        }

        return $callback;
    }




    /**
     * @param array|string $methods
     *
     * @return array
    */
    private function resolveMethods(array|string $methods): array
    {
        if (is_string($methods)) {
            $methods = explode('|', $methods);
        }

        return $methods;
    }



    /**
     * @param array $params
     * @return array
    */
    private function getDependencies(array $params): array
    {
        return array_merge([$this->getValuesOfParams(), array_values($params)]);
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

}