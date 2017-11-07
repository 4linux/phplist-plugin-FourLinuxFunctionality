<?php

defined('PHPLISTINIT') || die;

use phplist\FourLinux\Functionality\Interfaces\Shared\Route;
use phplist\FourLinux\Functionality\Interfaces\Controllers\Site\IndexController;

$routes = [];
$routes['index'] = new IndexController();

(new Route($routes))->dispatch();
