<?php

use App\Calculators\Calculator;
use App\Models\Credit;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testChangeDebtForPeriod(array $data, array $expected)
    {
        $credit = new Credit(...$data);
        (new Calculator($credit))->changeDebtForPeriod();
        $this->assertEquals($expected['debt'], round($credit->debt, 2));
    }

    public function dataProvider(): array
    {
        return [
            [
                [0.1, 100000, 12, 'diff'],
                ['debt' => 91666.67],
            ],
            [
                [0.2, 100000, 12, 'diff'],
                ['debt' => 91666.67],
            ],
            [
                [0.2, 150000, 12, 'diff'],
                ['debt' => 137500.0],
            ],
            [
                [0.1, 100000, 12, 'annuity'],
                ['debt' => 92041.74],
            ],
            [
                [0.2, 100000, 12, 'annuity'],
                ['debt' => 92403.22],
            ],
            [
                [0.2, 150000, 12, 'annuity'],
                ['debt' => 138604.82]
            ],
        ];
    }
}
