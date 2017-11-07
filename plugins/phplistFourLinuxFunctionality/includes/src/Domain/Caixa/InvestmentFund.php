<?php

namespace phplist\FourLinux\Functionality\Domain\Model\Caixa;

/**
 * Class InvestmentFund
 *
 * @package phplist\FourLinux\Functionality\Domain\Model\Caixa
 */
class InvestmentFund
{
    /**
     * @var integer
     */
    private $modalityNumber;

    /**
     * FundInvestiment constructor.
     *
     * @param int $modalityNumber
     */
    public function __construct($modalityNumber)
    {
        $this->modalityNumber = $modalityNumber;
    }

    /**
     * @return int
     */
    public function getModalityNumber()
    {
        return $this->modalityNumber;
    }
}
