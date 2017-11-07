<?php

defined('PHPLISTINIT') || die;

use phplist\Caixa\Functionality\Interfaces\Shared\Route;
use phplist\Caixa\Functionality\Interfaces\Controllers\Site\IndexController;
use phplist\Caixa\Functionality\Interfaces\Controllers\Site\TestController;

$routes = [];
$routes['index'] = new IndexController();
$routes['validapo'] = new TestController();

(new Route($routes))->dispatch();
