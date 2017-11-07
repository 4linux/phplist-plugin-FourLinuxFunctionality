<?php

defined('PHPLISTINIT') || die;

use phplist\FourLinux\Functionality\Interfaces\Shared\Route;
use phplist\FourLinux\Functionality\Interfaces\Controllers\Site\IndexController;
use phplist\FourLinux\Functionality\Interfaces\Controllers\Site\TestController;

$routes = [];
$routes['index'] = new IndexController();
$routes['validapo'] = new TestController();

(new Route($routes))->dispatch();
