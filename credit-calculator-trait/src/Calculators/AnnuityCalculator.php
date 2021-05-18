<?php

namespace App\Calculators;

class AnnuityCalculator
{
    use CalculatorTrait;

    public function getMonthlyPayment(): float
    {
        return $this->credit->creditSum *
            (
                $this->credit->monthlyPercent + $this->credit->monthlyPercent /
                (pow((1 + $this->credit->monthlyPercent), $this->credit->term) - 1)
            );
    }

    public function getPercentDebtPayment(): float
    {
        return $this->credit->debt * $this->credit->monthlyPercent;
    }

    public function getMainDebtPayment(): float
    {
        return $this->getMonthlyPayment() - $this->getPercentDebtPayment();
    }
}
