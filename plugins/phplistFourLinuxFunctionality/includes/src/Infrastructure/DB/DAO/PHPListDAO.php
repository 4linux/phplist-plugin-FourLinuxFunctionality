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

    const USER_ATTR_CLIENTE_IDENTIFICADOR = 1;
    const USER_ATTR_CLIENTE_NOME = 2;
    const USER_ATTR_CLIENTE_EMAIL = 3;

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

    public function findListByName($name)
    {
        $sql = <<<SQL
SELECT * FROM {$this->getTables()['list']} WHERE name = ?  
SQL;
        $connectionPDO = $this->connection->getPDO();
        $connectionPDOStmt = $connectionPDO->prepare($sql);
        $connectionPDOStmt->execute([$name]);

        return $connectionPDOStmt->fetch(\PDO::FETCH_ASSOC);

    }

    public function insertList($name)
    {
        $insert = <<<SQL
        INSERT INTO phplist.phplist_list
            (
                name,
                active
            )
        VALUES
            (
              ?,
              ?
            )

SQL;

        $connectionPDO = $this->connection->getPDO();
        $connectionPDOStmt = $connectionPDO->prepare($insert);
        $connectionPDOStmt->execute([$name, true]);
        return $connectionPDO->lastInsertId();

    }

    public function findUserByIdentficadorCliente($identificadorCliente)
    {
        $sql = <<<SQL
select 
user.id as id, 
user.email as email, 
user.confirmed as confirmed, 
attr1.value as cliente_identificador, 
attr2.value as cliente_nome
from 
phplist_user_user user
INNER JOIN phplist_user_user_attribute attr1 ON user.id = attr1.userid and attr1.attributeid=1
INNER JOIN phplist_user_user_attribute attr2 ON user.id = attr2.userid and attr2.attributeid=2

WHERE attr1.value = ?

SQL;
        $connectionPDO = $this->connection->getPDO();
        $connectionPDOStmt = $connectionPDO->prepare($sql);
        $connectionPDOStmt->execute([$identificadorCliente]);

        return $connectionPDOStmt->fetch(\PDO::FETCH_ASSOC);


    }

    public function insertUser($email)
    {
        $insert = <<<SQL
INSERT INTO phplist.phplist_user_user
(
    email,
    confirmed,
    entered
)
VALUES
(
    ?,
    ?,
    ?
)
SQL;
        $now = date('Y-m-d H:i:s');
        $connectionPDO = $this->connection->getPDO();
        $connectionPDOStmt = $connectionPDO->prepare($insert);
        $connectionPDOStmt->execute([$email, 0, $now]);
        return $connectionPDO->lastInsertId();

    }

    public function updateUser($id, $email)
    {
        $update = <<<SQL

UPDATE phplist.phplist_user_user
SET email = ?
WHERE id = ?
SQL;

        $connectionPDO = $this->connection->getPDO();
        $connectionPDOStmt = $connectionPDO->prepare($update);
        $connectionPDOStmt->execute([$email, $id]);
    }

    public function updateUserAttributeValue($userId, $attrId, $value)
    {
        $update = <<<SQL

UPDATE phplist.phplist_user_user_attribute
SET value = ?
WHERE attributeid = ?
and userid = ?
SQL;
        $connectionPDO = $this->connection->getPDO();
        $connectionPDOStmt = $connectionPDO->prepare($update);
        $connectionPDOStmt->execute([$value, $attrId, $userId]);
    }

    public function insertUserAttributeValue($userId, $attrId, $value)
    {
        $insert = <<<SQL
INSERT INTO phplist.phplist_user_user_attribute
(
  userid,
  attributeid,
  value
)
VALUES
(
    ?,
    ?,
    ?
)
SQL;
        $connectionPDO = $this->connection->getPDO();
        $connectionPDOStmt = $connectionPDO->prepare($insert);
        $connectionPDOStmt->execute([$userId, $attrId, $value]);

    }

    public function insertUserList($userId, $listId)
    {
        $insert = <<<SQL
INSERT INTO phplist.phplist_listuser
(
  userid,
  listid, 
  entered
  )
VALUES(
  ?,
  ?,
  ?
)
SQL;
        $now = date('Y-m-d H:i:s');
        $connectionPDO = $this->connection->getPDO();
        $connectionPDOStmt = $connectionPDO->prepare($insert);
        $connectionPDOStmt->execute([$userId, $listId, $now]);

    }

    public function findUserList($userId, $listId)
    {
        $sql = <<<SQL
SELECT * FROM  phplist.phplist_listuser
WHERE userid = ? and listid = ?
SQL;

        $connectionPDO = $this->connection->getPDO();
        $connectionPDOStmt = $connectionPDO->prepare($sql);
        $connectionPDOStmt->execute([$userId, $listId]);
        return $connectionPDOStmt->fetch(\PDO::FETCH_ASSOC);

    }

    public function findOneListInvestmentFund($userId, $listId)
    {
        $sql = <<<SQL
SELECT 
  * 
FROM 
  phplist_caixa_list_investment_fund
WHERE
  usr_id = ?
  AND list_id = ?;
SQL;

        $connectionPDO = $this->connection->getPDO();
        $connectionPDOStmt = $connectionPDO->prepare($sql);
        $connectionPDOStmt->execute([
            $userId,
            $listId,
        ]);

        return $connectionPDOStmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function insertListInvestmentFund($userId, $listId, array $investmentFund)
    {
        $sql = <<<SQL
INSERT INTO 
  phplist_caixa_list_investment_fund
  (
    usr_id,
    list_id,
    reference_date,
    agency_number,
    operation_number,
    account_number,
    agency_email,
    modality_number
  )
VALUES
  (
    ?, ?, ?, ?, ?, ?, ?, ?
  );
SQL;

        $connectionPDO = $this->connection->getPDO();
        $connectionPDOStmt = $connectionPDO->prepare($sql);
        $connectionPDOStmt->execute([
            $userId,
            $listId,
            $investmentFund['dt_referencia'],
            $investmentFund['nu_agencia'],
            $investmentFund['nu_operacao'],
            $investmentFund['nu_conta'],
            $investmentFund['de_email_agencia'],
            $investmentFund['nu_modalidade'],
        ]);
    }

    public function updateListInvestmentFund($userId, $listId, array $investmentFund)
    {
        $sql = <<<SQL
UPDATE 
  phplist_caixa_list_investment_fund 
SET
  reference_date = ?,
  agency_number = ?,
  operation_number = ?,
  account_number = ?,
  agency_email = ?,
  modality_number = ?
WHERE
  usr_id = ?
  AND list_id = ?;
SQL;

        $connectionPDO = $this->connection->getPDO();
        $connectionPDOStmt = $connectionPDO->prepare($sql);
        $connectionPDOStmt->execute([
            $investmentFund['dt_referencia'],
            $investmentFund['nu_agencia'],
            $investmentFund['nu_operacao'],
            $investmentFund['nu_conta'],
            $investmentFund['de_email_agencia'],
            $investmentFund['nu_modalidade'],
            $userId,
            $listId,
        ]);
    }
}
