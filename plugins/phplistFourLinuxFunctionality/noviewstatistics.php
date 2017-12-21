<?php

defined('PHPLISTINIT') || die;

use phplist\FourLinux\Functionality\Interfaces\Shared\Route;
use phplist\FourLinux\Functionality\Interfaces\Controllers\Reports\UnreadEmails\IndexController;
use phplist\FourLinux\Functionality\Interfaces\Controllers\Reports\UnreadEmails\UnreadEmailsController;
use phplist\FourLinux\Functionality\Interfaces\Controllers\Reports\UnreadEmails\ExportUsersToCsvController;

$routes = [];
$routes['index'] = new IndexController();
$routes['unreademails'] = new UnreadEmailsController();
$routes['exportusers'] = new ExportUsersToCsvController();

(new Route($routes))->dispatch();
