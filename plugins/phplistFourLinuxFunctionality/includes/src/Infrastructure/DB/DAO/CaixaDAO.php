<?php

namespace phplist\FourLinux\Functionality\Infrastructure\DB\DAO;

use phplist\FourLinux\Functionality\Infrastructure\Shared\AbstractDAO;

/**
 * Class CaixaDAO
 *
 * @package phplist\FourLinux\Functionality\Infrastructure\DB\DAO
 */
class CaixaDAO extends AbstractDAO
{
    public function findAllInvestmentFunds()
    {
        $sql = <<<SQL
select distinct 
  nu_modalidade 
from 
  lissm001.lisvw001_lista_email;
SQL;

        $connectionPDO = $this->connection->getPDO();
        $connectionPDOStmt = $connectionPDO->prepare($sql);
        $connectionPDOStmt->execute();

        $fundNames = [];
        foreach ($connectionPDOStmt->fetchAll(\PDO::FETCH_ASSOC) as $fetched) {
            $fundNames[] = $fetched['nu_modalidade'];
        }

        return $fundNames;
    }

    public function findListEmailByNuModalidade($nuModalidade)
    {
        $sql = <<<SQL
SELECT *
     FROM lissm001.lisvw001_lista_email
     WHERE nu_modalidade = :nuModalidade
SQL;
        $connectionPDO = $this->connection->getPDO();
        $connectionPDOStmt = $connectionPDO->prepare($sql);
        $connectionPDOStmt->execute([$nuModalidade]);
        return $connectionPDOStmt->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function getTables()
    {
        return [
            'fundo_investimento' => 'lissm001.listb001_fundo_investimento',
        ];
    }

    public function getTablePrefix()
    {
        return '';
    }
}
