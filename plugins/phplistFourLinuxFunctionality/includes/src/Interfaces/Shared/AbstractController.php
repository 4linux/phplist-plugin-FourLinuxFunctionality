<?php

namespace phplist\FourLinux\Functionality\Interfaces\Shared;

/**
 * Class AbstractController
 *
 * @package phplist\FourLinux\Functionality\Interfaces\Shared
 */
abstract class AbstractController
{
    public function render($view, array $params = array())
    {
        $view = new View($view, $params);
        return $view->render();
    }
}
