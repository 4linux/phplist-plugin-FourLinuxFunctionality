<?php

namespace phplist\Caixa\Functionality\Domain\Model\Caixa;

/**
 * Interface InvestmentFundRepositoryInterface
 *
 * @package phplist\Caixa\Functionality\Domain\Model\Caixa
 */
interface InvestmentFundRepositoryInterface
{
    /**
     * @return InvestmentFund[]
     */
    public function findAll();
}
