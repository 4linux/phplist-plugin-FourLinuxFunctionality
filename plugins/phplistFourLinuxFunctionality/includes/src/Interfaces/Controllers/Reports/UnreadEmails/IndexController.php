<?php
namespace phplist\FourLinux\Functionality\Interfaces\Controllers\Reports\UnreadEmails;

use phplist\FourLinux\Functionality\Interfaces\Shared\AbstractController;
use phplist\FourLinux\Functionality\Interfaces\Models\Messages;

/**
 * Class IndexController
 *
 * @package phplist\FourLinux\Functionality\Interfaces\Controllers\Site
 */
class IndexController extends AbstractController
{
    
    private $reportUnread;
    
    public function __construct()
    {
        $this->reportUnread = new Messages();
    }

    public function __invoke()
    {
        $plugin = $GLOBALS['plugins'][$_GET['pi']];
        
        $unseenemails = $this->reportUnread->listAllMessages();
        
        echo $this->render('reports/noviewstatistics/index', [
            'unseenemails' => $unseenemails
        ]);
    }
}
