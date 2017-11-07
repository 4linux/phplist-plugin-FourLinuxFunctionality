<?php

namespace phplist\Caixa\Functionality\Infrastructure\Shared;

use phplist\Caixa\Functionality\Infrastructure\DB\Connection;
use phplist\Caixa\Functionality\Infrastructure\DB\DAO\CaixaDAO;
use phplist\Caixa\Functionality\Infrastructure\DB\DAO\PHPListDAO;

/**
 * Class AbstractDAOFactory
 *
 * @package phplist\Caixa\Functionality\Infrastructure\Shared
 */
abstract class AbstractDAOFactory
{
    public static function get($clazz)
    {
        static $factories;

        if (!isset($factories)) {
            $factories = [
                CaixaDAO::class => function () {
                    return new CaixaDAO(Connection::fromCaixa());
                },
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
