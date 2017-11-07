<?php

namespace phplist\FourLinux\Functionality\Infrastructure\DB\DAO;

use phplist\FourLinux\Functionality\Infrastructure\Shared\AbstractDAO;

/**
 * Class PHPListDAO
 *
 * @package phplist\FourLinux\Functionality\Infrastructure\DB\DAO
 */
class PHPListDAO extends AbstractDAO
{
    public function deleteUserMessageByNotViewed($messageId)
    {
        $sql = <<<SQL
DELETE FROM 
  {$this->getTables()['usermessage']}
WHERE 
  messageid = ?
  AND viewed is null;
SQL;

        $connectionPDO = $this->connection->getPDO();
        $connectionPDOStmt = $connectionPDO->prepare($sql);
        $connectionPDOStmt->execute([
            $messageId,
        ]);
    }
}
