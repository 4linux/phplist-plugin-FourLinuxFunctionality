<?php

namespace phplist\Caixa\Functionality\Interfaces\Controllers\Site;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use phplist\Caixa\Functionality\Domain\Shared\AbstractServiceFactory;
use phplist\Caixa\Functionality\Domain\UserImportService;
use phplist\Caixa\Functionality\Infrastructure\DB\Connection;
use phplist\Caixa\Functionality\Infrastructure\DB\DAO\CaixaDAO;
use phplist\Caixa\Functionality\Infrastructure\DB\DAO\PHPListDAO;
use phplist\Caixa\Functionality\Infrastructure\Shared\AbstractDAOFactory;
use phplist\Caixa\Functionality\Interfaces\Shared\AbstractController;


/**
 * Class TestController
 *
 * @package phplist\Caixa\Functionality\Interfaces\Controllers\Site
 */
class TestController extends AbstractController
{


    public function __invoke()
    {
        /** @var CaixaDAO $caixaDAO */
        $caixaDAO = AbstractDAOFactory::get(CaixaDAO::class);
        $investmentFunds = $caixaDAO->findAllInvestmentFunds();

        $table = new \WebblerListing( 'Nº do Fundo de Investimento' );
        foreach ( $investmentFunds as $investmentFund ) {
            $table->addElement( $investmentFund );
        }

        $needle = '<div class="header"><h2>Nº do Fundo de Investimento</h2></div>';
        $replace = '<div class="header"><h2>Fundos de Investimento</h2></div>';
        echo str_replace( $needle, $replace, $table->display() );

        /** @var UserImportService $instance */
        $instance = AbstractServiceFactory::get(UserImportService::class);
        $connection = Connection::fromPHPList();

        try{
            $connection->getPDO()->beginTransaction();
            $instance->executeUserImportByFund(5901);
            $instance->executeUserImportByFund(5930);
            $instance->executeUserImportByFund(5948);
            $connection->getPDO()->commit();
        }catch (\Exception $e){
            echo($e->getMessage());
            $connection->getPDO()->rollBack();
        }

    }
}
