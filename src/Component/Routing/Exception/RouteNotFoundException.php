<?php
namespace Laventure\Component\Routing\Exception;

use Exception;

/**
 * @RouteNotFoundException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Exception
 */
class RouteNotFoundException extends Exception
{

    /**
     * @param string $message
    */
    public function __construct(string $message = "")
    {
        parent::__construct($message, 404);
    }
}