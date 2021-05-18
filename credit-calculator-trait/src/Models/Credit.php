<?php

namespace App\Models;

class Credit
{
    public const TYPE_DIFFERENTIAL = 'diff';
    public const TYPE_ANNUITY = 'annuity';

    public float $percent;
    public float $monthlyPercent;
    public float $creditSum;
    public float $debt;
    public int $term;
    public string $type;
    public int $termPassed = 0;

    public function __construct(float $percent, float $creditSum, int $term, string $type)
    {
        $this->percent = $percent;
        $this->monthlyPercent = $percent / 12;
        $this->creditSum = $creditSum;
        $this->debt = $creditSum;
        $this->term = $term;
        $this->type = $type;
    }
}
