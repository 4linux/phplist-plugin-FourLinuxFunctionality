<?php

namespace phplist\FourLinux\Functionality\Infrastructure\Shared;

use phplist\FourLinux\Functionality\Infrastructure\DB\Connection;
use phplist\FourLinux\Functionality\Infrastructure\DB\DAO\CaixaDAO;
use phplist\FourLinux\Functionality\Infrastructure\DB\DAO\PHPListDAO;

/**
 * Class AbstractDAOFactory
 *
 * @package phplist\FourLinux\Functionality\Infrastructure\Shared
 */
abstract class AbstractDAOFactory
{
    public static function get($clazz)
    {
        static $factories;

        if (!isset($factories)) {
            $factories = [
                PHPListDAO::class => function () {
                    return new PHPListDAO(Connection::fromPHPList());
                },
            ];
        }

        $factory = null;
        if (array_key_exists($clazz, $factories)) {
            $factory = $factories[$clazz];
        }

        return is_callable($factory) ? $factory() : null;
    }
}
