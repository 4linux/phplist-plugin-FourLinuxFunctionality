<?php

namespace phplist\FourLinux\Functionality\Domain;

use phplist\FourLinux\Functionality\Infrastructure\Shared\PHPList;

/**
 * Class MessageDataService
 *
 * @package phplist\FourLinux\Functionality\Domain
 */
class MessageDataService
{
    private $phpList;

    public function __construct(PHPList $phpList)
    {
        $this->phpList = $phpList;
    }

    public function setAlwaysSendToNotViewed($messageId, $value)
    {
        $this->phpList->setMessageData($messageId, 'alwaysSendToNotViewed', boolval($value));
    }
}
