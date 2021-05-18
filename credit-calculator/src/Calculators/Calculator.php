<?php

namespace App\Calculators;

use App\Models\Credit;

class Calculator extends AbstractCalculator
{
    protected $calculator;

    public function __construct(Credit $credit)
    {
        parent::__construct($credit);

        switch ($credit->type) {
            case Credit::TYPE_DIFFERENTIAL:
                $this->calculator = new DifferentialCalculator($credit);
                break;
            case Credit::TYPE_ANNUITY:
                $this->calculator = new AnnuityCalculator($credit);
                break;
        }
    }

    public function getMonthlyPayment(): float
    {
        return $this->calculator->getMonthlyPayment();
    }

    public function getMainDebtPayment(): float
    {
        return $this->calculator->getMainDebtPayment();
    }

    public function getPercentDebtPayment(): float
    {
        return $this->calculator->getPercentDebtPayment();
    }
}
