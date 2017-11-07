<?php

namespace phplist\Caixa\Functionality\Domain\Model\Caixa;

/**
 * Class Client
 *
 * @package phplist\Caixa\Functionality\Domain\Model\Caixa
 */
class Client
{
    /**
     * @var integer
     */
    private $identifier;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * Client constructor.
     *
     * @param int $identifier
     * @param string $name
     * @param string $email
     */
    public function __construct($identifier, $name, $email)
    {
        $this->identifier = $identifier;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}
