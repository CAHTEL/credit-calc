<?php

namespace App\ReportGenerators;

interface GeneratorInterface
{
    public function generateReport(array $creditInfo): string;
}
