<?php
namespace phplist\FourLinux\Functionality\Interfaces\Controllers\Reports\UnreadEmails;

use phplist\FourLinux\Functionality\Interfaces\Shared\AbstractController;
use phplist\FourLinux\Functionality\Interfaces\Models\UnreadEmails;
use phplist\FourLinux\Functionality\Interfaces\Models\ExportUsers;

/**
 * Class IndexController
 *
 * @package phplist\FourLinux\Functionality\Interfaces\Controllers\Site
 */
class ExportUsersToCsvController extends AbstractController
{
    
    private $exportUsers;
    
    public function __construct()
    {
        $this->exportUsers = new ExportUsers();
    }

    public function __invoke()
    {
        ob_end_clean();
        ob_start();
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=users.csv');
        
        $messageId = $_GET['messageid'];

        $this->exportUsers->exportUsersNoReadEmail($messageId);
        
        exit();
    }
}
