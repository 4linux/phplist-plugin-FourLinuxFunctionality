<?php
namespace phplist\FourLinux\Functionality\Interfaces\Models;

use phplist\FourLinux\Functionality\Infrastructure\DB\DAO\PHPListDAO;
use phplist\FourLinux\Functionality\Infrastructure\Shared\AbstractDAOFactory;

class UnreadEmails
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
    
    public function listAllUsersNoRead($messageId)
    {
        return $this->phplistDao->listUsersNoReadEmails($messageId);
    }
}