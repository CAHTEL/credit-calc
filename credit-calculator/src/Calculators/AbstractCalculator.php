<?php

namespace App\Calculators;

use App\Models\Credit;
use App\Models\CreditInfo;

abstract class AbstractCalculator
{
    protected Credit $credit;

    abstract public function getMonthlyPayment(): float;
    abstract public function getMainDebtPayment(): float;
    abstract public function getPercentDebtPayment(): float;

    public function __construct(Credit $credit)
    {
        $this->credit = $credit;
    }

    public function changeDebtForPeriod(int $term = 1): void
    {
        $this->credit->debt = $this->credit->debt - ($this->getMainDebtPayment() * $term);
    }

    public function getCreditDebt(): float
    {
        return $this->credit->debt;
    }

    public function calculateForPeriod(?int $term = null): array
    {
        $result = [];
        $term = $term ?? $this->credit->term;

        for ($i = 0; $i < $term; $i++) {
            $monthlyPayment = $this->getMonthlyPayment();
            $percentPart = $this->getPercentDebtPayment();
            $mainDebtPart = $this->getMainDebtPayment();
            $this->changeDebtForPeriod();
            $result[] = new CreditInfo(
                $monthlyPayment,
                $percentPart,
                $mainDebtPart,
                $this->getCreditDebt()
            );
            $this->credit->termPassed++;
        }

        return $result;
    }

    public function calculateAllPercent(): float
    {
        $info = $this->calculateForPeriod();
        $sum = 0;

        foreach ($info as $monthCreditInfo)
        {
            $sum += $monthCreditInfo->percentPart;
        }

        return $sum;
    }

}
