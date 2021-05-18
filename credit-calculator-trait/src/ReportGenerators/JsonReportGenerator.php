<?php


namespace App\ReportGenerators;

use App\Calculators\AbstractCalculator;
use App\Models\Credit;

class JsonReportGenerator implements GeneratorInterface
{
    public function generateReport(array $creditInfo): string
    {
        return json_encode($creditInfo);
    }
}
