<?php

namespace App\Calculators;

class DifferentialCalculator extends AbstractCalculator
{
    public function getMonthlyPayment(): float
    {
        return $this->getMainDebtPayment() + $this->getPercentDebtPayment();
    }

    public function getMainDebtPayment(): float
    {
        return $this->credit->creditSum / $this->credit->term;
    }

    public function getPercentDebtPayment(): float
    {
        return ($this->credit->creditSum - ($this->getMainDebtPayment() * $this->credit->termPassed)) * $this->credit->monthlyPercent;
    }
}
