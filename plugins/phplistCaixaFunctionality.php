<?php

defined('PHPLISTINIT') || die;

use phplist\Caixa\Functionality\Domain\Shared\AbstractServiceFactory;
use phplist\Caixa\Functionality\Domain\MessageDataService;
use phplist\Caixa\Functionality\Domain\UserMessageService;
use phplist\Caixa\Functionality\Interfaces\Models\MessageTab;
use phplist\Caixa\Functionality\Interfaces\Shared\View;

/**
 * Class phplistCaixaFunctionality
 */
class phplistCaixaFunctionality extends phplistPlugin
{
    public $name = 'Caixa Functionality';
    public $description = 'Biblioteca de funcionalidades do phplistCaixa';
    public $version = '0.1.0';

    public $pageTitles = array(
        'site' => 'phpList da Caixa',
        'about' => 'Sobre o phpList da Caixa',
    );

    public $topMenuLinks = array(
        'site' => array('category' => 'system'),
    );

    /**
     * phplistCaixaFunctionality constructor.
     */
    function __construct()
    {
        $this->coderoot = dirname(__FILE__) . '/phplistCaixaFunctionality/';
        parent::__construct();
    }

    public function activate()
    {
        global $plugins;
        require_once $plugins['phplistCaixaFunctionality']->coderoot . 'includes/src/autoload.php';

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
            'messageTab' => $messageTab,
        ]);

        return $view->render();
    }

    public function sendMessageTabTitle($messageId = 0)
    {
        return 'Caixa';
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
