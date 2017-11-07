<?php

namespace phplist\FourLinux\Functionality\Interfaces\Controllers\Site;

use phplist\FourLinux\Functionality\Interfaces\Shared\AbstractController;

/**
 * Class IndexController
 *
 * @package phplist\FourLinux\Functionality\Interfaces\Controllers\Site
 */
class IndexController extends AbstractController
{
    public function __invoke()
    {
        echo $this->render('site/index');
    }
}
