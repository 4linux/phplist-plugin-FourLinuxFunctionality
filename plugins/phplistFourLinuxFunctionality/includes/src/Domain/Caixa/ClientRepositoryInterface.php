<?php

namespace phplist\Caixa\Functionality\Domain\Model\Caixa;

/**
 * Interface ClientRepositoryInterface
 *
 * @package phplist\Caixa\Functionality\Domain\Model\Caixa
 */
interface ClientRepositoryInterface
{
    /**
     * @param InvestmentFund $investmentFund
     * @return Client[]
     */
    public function findAllByInvestmentFund(InvestmentFund $investmentFund);

    /**
     * @param $identifier
     * @return Client
     */
    public function findOneByIdentifier($identifier);
}