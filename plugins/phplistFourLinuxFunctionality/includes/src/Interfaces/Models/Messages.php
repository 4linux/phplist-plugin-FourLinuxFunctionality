<?php
namespace phplist\FourLinux\Functionality\Interfaces\Models;

use phplist\FourLinux\Functionality\Infrastructure\DB\DAO\PHPListDAO;
use phplist\FourLinux\Functionality\Infrastructure\Shared\AbstractDAOFactory;

class Messages
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
    
    public function listAllMessages()
    {
        return $this->phplistDao->listMessages();
    }
}