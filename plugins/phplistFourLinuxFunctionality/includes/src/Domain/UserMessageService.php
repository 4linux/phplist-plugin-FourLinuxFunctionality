<?php

namespace phplist\FourLinux\Functionality\Domain;

use phplist\FourLinux\Functionality\Infrastructure\DB\DAO\PHPListDAO;
use phplist\FourLinux\Functionality\Infrastructure\Shared\PHPList;

/**
 * Class UserMessageService
 *
 * @package phplist\FourLinux\Functionality\Domain
 */
class UserMessageService
{
    private $phpList;
    private $phpListDAO;

    public function __construct(PHPList $phpList, PHPListDAO $phpListDAO)
    {
        $this->phpList = $phpList;
        $this->phpListDAO = $phpListDAO;
    }

    public function maybeSendToNotViewed($messageId)
    {
        $messageData = $this->phpList->loadMessageData($messageId);
        if (isset($messageData['alwaysSendToNotViewed'])) {
            if (boolval($messageData['alwaysSendToNotViewed'])) {
                $this->phpListDAO->deleteUserMessageByNotViewed($messageId);
            }
        }
    }
}
