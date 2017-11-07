<?php

namespace phplist\Caixa\Functionality\Infrastructure\Shared;

use phplist\Caixa\Functionality\Infrastructure\DB\Connection;

/**
 * Class AbstractDAO
 *
 * @package phplist\Caixa\Functionality\Infrastructure\Shared
 */
abstract class AbstractDAO
{
    protected $connection;

    private $tables;
    private $tablePrefix;

    /**
     * AbstractDAO constructor.
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;

        global $tables;
        global $table_prefix;

        $this->tables = $tables;
        $this->tablePrefix = $table_prefix;
    }

    protected function getTables()
    {
        return $this->tables;
    }

    protected function getTablePrefix()
    {
        return $this->tablePrefix;
    }
}
