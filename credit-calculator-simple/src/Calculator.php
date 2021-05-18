<?php

namespace App;

class Calculator
{
    public function calculateForAllPeriod(float $percent, float $sum, int $term, string $type): array
    {
        $payments = [];
        $debt = $sum;

        for ($currentMonth = 0; $currentMonth < $term; $currentMonth++) {
            switch ($type) {
                case 'diff':
                    $payment = $this->calculateForDifferentialPayment($percent, $sum, $term, $debt, $currentMonth);
                    break;
                case 'ann':
                    $payment = $this->calculateForAnnuityPayment($percent, $sum, $term, $debt, $currentMonth);
                    break;
            }

            $payments[] = $payment;
            $debt = $payment['debt'];
        }

        return $payments;
    }

    public function generateReport(float $percent, float $sum, int $term, string $type): void
    {
        $payments = $this->calculateForAllPeriod($percent, $sum, $term, $type);

        foreach ($payments as $info) {
            printf("Платеж в месяц: %.2f \t Процентная часть %.2f \t Часть от ОД %.2f \t Остаток задолжности %.2f \n",
                $info['monthlyPayment'],
                $info['percentPart'],
                $info['mainDebtPart'],
                $info['debt'],
            );
        }
    }

    public function calculateForAnnuityPayment(
        float $percent,
        float $sum,
        int $term,
        float $debt,
        int $currentMonth = 0
    ): array {

        $monthlyPercent = $percent / 12;
        $monthlyPayment = $sum * ($monthlyPercent + ($monthlyPercent / (pow((1 + $monthlyPercent), $term) - 1)));
        $percentPart = $debt * $monthlyPercent;
        $mainDebtPart = $monthlyPayment - $percentPart;
        $debt = $debt - $mainDebtPart;

        return [
            'mainDebtPart' => $mainDebtPart,
            'percentPart' => $percentPart,
            'monthlyPayment' => $monthlyPayment,
            'debt' => $debt,
        ];
    }

    public function calculateForDifferentialPayment(
        float $percent,
        float $sum,
        int $term,
        float $debt,
        int $currentMonth = 0
    ): array {
        $monthlyPercent = $percent / 12;
        $mainDebtPart = $sum / $term;
        $percentPart = ($sum - ($mainDebtPart * $currentMonth)) * $monthlyPercent;
        $monthlyPayment = $mainDebtPart + $percentPart;
        $debt = $debt - $mainDebtPart;

        return [
            'mainDebtPart' => $mainDebtPart,
            'percentPart' => $percentPart,
            'monthlyPayment' => $monthlyPayment,
            'debt' => $debt,
        ];
    }
}