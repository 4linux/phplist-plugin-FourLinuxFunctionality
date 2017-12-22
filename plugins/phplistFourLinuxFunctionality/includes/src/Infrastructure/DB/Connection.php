<?php
namespace phplist\FourLinux\Functionality\Infrastructure\DB;

/**
 * Class Connection
 *
 * @package phplist\FourLinux\Functionality\Infrastructure\DB
 */
class Connection
{

    private $dsn;

    private $username;

    private $passwd;

    private $pdo = null;

    /**
     * Connection constructor.
     *
     * @param
     *            $dsn
     * @param
     *            $username
     * @param
     *            $passwd
     */
    private function __construct($dsn, $username, $passwd)
    {
        $this->dsn = $dsn;
        $this->username = $username;
        $this->passwd = $passwd;
    }

    public function getPDO()
    {
        if (is_null($this->pdo)) {
            $this->pdo = new \PDO($this->dsn, $this->username, $this->passwd, array(
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        
        return $this->pdo;
    }

    /**
     * Get the current connection for internal MySQL/PHPList database.
     *
     * @return Connection
     */
    public static function fromPHPList()
    {
        static $connection;
        
        if (! isset($connection)) {
            $dbname = $GLOBALS['database_name'];
            $host = $GLOBALS['database_host'];
            $username = $GLOBALS['database_user'];
            $passwd = $GLOBALS['database_password'];
            $connection = new Connection("mysql:host={$host};dbname={$dbname}", $username, $passwd);
        }
        return $connection;
    }
}
