<?php
defined('PHPLISTINIT') || die();

use phplist\FourLinux\Functionality\Domain\Shared\AbstractServiceFactory;
use phplist\FourLinux\Functionality\Domain\MessageDataService;
use phplist\FourLinux\Functionality\Domain\UserMessageService;
use phplist\FourLinux\Functionality\Interfaces\Models\MessageTab;
use phplist\FourLinux\Functionality\Interfaces\Shared\View;

/**
 * Class phplistFourLinuxFunctionality
 */
class phplistFourLinuxFunctionality extends phplistPlugin
{

    public $name = 'FourLinux Functionality';

    public $description = 'Biblioteca de funcionalidades do phplistFourLinux';

    public $version = '0.1.0';

    public $pageTitles = array(
        'site' => 'phpList da 4Linux',
        'about' => 'Sobre o phpList da 4Linux',
        'noviewstatistics' => 'Estatisticas dos e-mails não vistos'
    );

    public $topMenuLinks = array(
        'site' => array(
            'category' => 'system'
        )
    );

    /**
     * phplistFourLinuxFunctionality constructor.
     */
    function __construct()
    {
        $this->coderoot = dirname(__FILE__) . '/phplistFourLinuxFunctionality/';
        parent::__construct();
    }

    public function activate()
    {
        global $plugins;
        require_once $plugins['phplistFourLinuxFunctionality']->coderoot . 'includes/src/autoload.php';
        
        parent::activate();
    }

    function adminMenu()
    {
        return $this->pageTitles;
    }

    public function sendMessageTab($messageId = 0, $messageData = array())
    {
        if (MessageTab::isSubmitted($_POST)) {
            
            $messageTab = MessageTab::fromPost($_POST);
            
            /** @var MessageDataService $messageDataService */
            $messageDataService = AbstractServiceFactory::get(MessageDataService::class);
            $messageDataService->setAlwaysSendToNotViewed($messageId, $messageTab->alwaysSendToNotViewed);
        } else {
            $messageTab = MessageTab::fromMessage($messageData);
        }
        
        $view = new View('sendMessage/tab', [
            'messageTab' => $messageTab
        ]);
        
        return $view->render();
    }

    public function sendMessageTabTitle($messageId = 0)
    {
        return '4Linux';
    }

    public function messageQueued($messageId)
    {
        /** @var UserMessageService $userMessageService */
        $userMessageService = AbstractServiceFactory::get(UserMessageService::class);
        $userMessageService->maybeSendToNotViewed($messageId);
    }

    public function messageReQueued($messageId)
    {
        /** @var UserMessageService $userMessageService */
        $userMessageService = AbstractServiceFactory::get(UserMessageService::class);
        $userMessageService->maybeSendToNotViewed($messageId);
    }
}
