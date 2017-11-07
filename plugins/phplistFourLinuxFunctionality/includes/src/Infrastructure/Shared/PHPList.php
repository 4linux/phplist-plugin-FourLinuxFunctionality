<?php

namespace phplist\FourLinux\Functionality\Infrastructure\Shared;

class PHPList
{
    public function setMessageData($messageId, $name, $value)
    {
        setMessageData($messageId, $name, $value);
    }

    public function loadMessageData($messageId)
    {
        return loadMessageData($messageId);
    }
}
