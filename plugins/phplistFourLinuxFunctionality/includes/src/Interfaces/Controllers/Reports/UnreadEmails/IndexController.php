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
        $start = isset($_GET['start']) ? $_GET['start'] : 0;
           
        $plugin = $GLOBALS['plugins'][$_GET['pi']];
        
        $unseenemails = $this->reportUnread->listAllMessages($start);
        
        echo $this->render('reports/noviewstatistics/index', [
            'unseenemails' => $unseenemails,
            'start' => $start
        ]);
    }
}
