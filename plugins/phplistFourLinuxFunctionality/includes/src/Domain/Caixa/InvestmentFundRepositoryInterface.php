<?php

namespace phplist\FourLinux\Functionality\Domain\Model\Caixa;

/**
 * Interface InvestmentFundRepositoryInterface
 *
 * @package phplist\FourLinux\Functionality\Domain\Model\Caixa
 */
interface InvestmentFundRepositoryInterface
{
    /**
     * @return InvestmentFund[]
     */
    public function findAll();
}
