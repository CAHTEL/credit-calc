<?php

namespace App\ReportGenerators;

class CustomReportGenerator implements GeneratorInterface
{
    public function generateReport(array $creditInfo): string
    {
        $report = '';

        foreach ($creditInfo as $info) {
            $report .= sprintf("Платеж в месяц: %.2f \t Процентная часть %.2f \t Часть от ОД %.2f \t Остаток задолжности %.2f \n",
                $info->monthlyPayment,
                $info->percentPart,
                $info->mainDebtPart,
                $info->debt,
            );
        }

        return $report;
    }
}
