<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 06/11/17
 * Time: 14:42
 */

namespace phplist\FourLinux\Functionality\Domain;


use phplist\FourLinux\Functionality\Infrastructure\DB\DAO\CaixaDAO;
use phplist\FourLinux\Functionality\Infrastructure\DB\DAO\PHPListDAO;

class UserImportService
{

    private $phpListDAO;
    private $caixaDAO;

    /**
     * UserImportService constructor.
     */
    public function __construct(CaixaDAO $caixaDAO, PHPListDAO $phpListDAO)
    {
        $this->caixaDAO = $caixaDAO;
        $this->phpListDAO = $phpListDAO;
    }

    private function findOrCreateListByName($name)
    {
        $list = $this->getListByName($name);

        if (!$list) {
            $listId = $this->phpListDAO->insertList($name);
            $list = $this->getListByName($name);
        }

        return $list;
    }

    private function getListByName($name)
    {
        return $this->phpListDAO->findListByName($name);
    }

    public function executeUserImportByFund($fundNumber)
    {
        $listEmails = $this->caixaDAO->findListEmailByNuModalidade($fundNumber);
        foreach ($listEmails as $listEmail) {


            $list = $this->findOrCreateListByName($listEmail['nu_modalidade']);

            $cliente = $this->phpListDAO->findUserByIdentficadorCliente($listEmail['co_identificador_cliente']);

            if (!$cliente) {
                if ($listEmail['de_email_cliente']) {
                    $userId = $this->phpListDAO->insertUser($listEmail['de_email_cliente']);
                    $this->phpListDAO->insertUserAttributeValue($userId, PHPListDAO::USER_ATTR_CLIENTE_IDENTIFICADOR, $listEmail['co_identificador_cliente']);
                    $this->phpListDAO->insertUserAttributeValue($userId, PHPListDAO::USER_ATTR_CLIENTE_NOME, $listEmail['no_cliente']);
                } else {

                    /**
                     * @TODO Vai ser tratado na história PHPLIST-79
                     */
                }
            } else {
                $this->phpListDAO->updateUser($cliente['id'], $listEmail['de_email_cliente']);
                $this->phpListDAO->updateUserAttributeValue($cliente['id'], PHPListDAO::USER_ATTR_CLIENTE_NOME, $listEmail['no_cliente']);
            }

            $cliente = $this->phpListDAO->findUserByIdentficadorCliente($listEmail['co_identificador_cliente']);
            $userList = $this->phpListDAO->findUserList($cliente['id'], $list['id']);
            $listInvestmentFund = $this->phpListDAO->findOneListInvestmentFund($cliente['id'], $list['id']);

            if (!$userList) {
                $this->phpListDAO->insertUserList($cliente['id'], $list['id']);
            }

            if (!$listInvestmentFund) {
                $this->phpListDAO->insertListInvestmentFund($cliente['id'], $list['id'], $listEmail);
            } else {
                $this->phpListDAO->updateListInvestmentFund($cliente['id'], $list['id'], $listEmail);
            }

        }
    }

}