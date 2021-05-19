<?php

namespace App\Models;

class CreditInfo
{
    public float $monthlyPayment;
    public float $percentPart;
    public float $mainDebtPart;
    public float $debt;

    public function __construct(
        float $monthlyPayment,
        float $percentPart,
        float $mainDebtPart,
        float $debt
    ) {
        $this->monthlyPayment = $monthlyPayment;
        $this->percentPart = $percentPart;
        $this->mainDebtPart = $mainDebtPart;
        $this->debt = $debt;
    }
}
