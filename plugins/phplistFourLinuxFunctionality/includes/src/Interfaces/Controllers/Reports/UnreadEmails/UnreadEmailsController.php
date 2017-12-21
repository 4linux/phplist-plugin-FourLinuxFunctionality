<?php
namespace phplist\FourLinux\Functionality\Interfaces\Controllers\Reports\UnreadEmails;

use phplist\FourLinux\Functionality\Interfaces\Shared\AbstractController;
use phplist\FourLinux\Functionality\Interfaces\Models\UnreadEmails;

/**
 * Class IndexController
 *
 * @package phplist\FourLinux\Functionality\Interfaces\Controllers\Site
 */
class UnreadEmailsController extends AbstractController
{
    
    private $reportUnread;
    
    public function __construct()
    {
        $this->reportUnread = new UnreadEmails();
    }

    public function __invoke()
    {
        $messageId = $_GET['id'];

        $unseenemails = $this->reportUnread->listAllUsersNoRead($messageId);
        
        echo $this->render('reports/noviewstatistics/unreademails', [
            'unseenemails' => $unseenemails
        ]);
    }
}
