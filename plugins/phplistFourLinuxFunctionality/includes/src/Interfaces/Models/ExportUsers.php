<?php
namespace phplist\FourLinux\Functionality\Interfaces\Models;

use phplist\FourLinux\Functionality\Infrastructure\DB\DAO\PHPListDAO;
use phplist\FourLinux\Functionality\Infrastructure\Shared\AbstractDAOFactory;

class ExportUsers
{

    /**
     *
     * @var PHPListDAO $phplistDao
     */
    protected $phplistDao;

    public function __construct()
    {
        $this->phplistDao = AbstractDAOFactory::get(PHPListDAO::class);
    }

    public function exportUsersNoReadEmail($messageId)
    {       
        $users = $this->phplistDao->listUsersNoReadEmails($messageId);
        
        $cabecalho = [
            'id',
            'email'
        ];
        
        $filename = "lista_nao_vistos.csv";
        
        $fp = fopen('php://output', 'w');
        
        fputcsv($fp, $cabecalho, ';');
        
        foreach ($users as $user) {
            fputcsv($fp, [$user['userid'], $user['email']], ';');
        }
    }
}