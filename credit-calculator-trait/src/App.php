<?php

namespace App;

use App\Calculators\Calculator;
use App\Models\Credit;
use App\ReportGenerators\GeneratorInterface;

class App
{
    public function generateReport(Credit $credit, GeneratorInterface $generator): void
    {
        $calculator = new Calculator($credit);
        $report = $generator->generateReport($calculator->calculateForPeriod());
        echo $report;
    }
}
