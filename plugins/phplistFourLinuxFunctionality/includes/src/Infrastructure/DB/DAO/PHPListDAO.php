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
            $messageId
        ]);
    }

    public function listMessages()
    {
        $sql = <<<SQL
SELECT * FROM
  {$this->getTables()['message']}
        WHERE sent IS NOT NULL ORDER BY id DESC
SQL;
        $connectionPDO = $this->connection->getPDO();
        $data = $connectionPDO->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }
    
    public function listUsersNoReadEmails($messageId)
    {
        $sql = <<<SQL
SELECT um.userid,um.messageid,user.email  FROM
  {$this->getTables()['usermessage']} AS um
INNER JOIN {$this->getTables()['user']} AS user 
    ON um.userid = user.id
WHERE um.viewed IS NULL AND um.messageid = $messageId
SQL;
      $connectionPDO = $this->connection->getPDO();
      $data = $connectionPDO->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
      return $data;
    }
}
