<?php

use App\Calculators\AnnuityCalculator;
use PHPUnit\Framework\TestCase;

class AnnuityCalculatorTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testGetMonthlyPayment(array $data, array $expected)
    {
        $credit = new \App\Models\Credit(...$data);
        $payment = round((new AnnuityCalculator($credit))->getMonthlyPayment(), 2);
        $this->assertEquals($expected['monthlyPayment'], $payment);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testGetPercentDebtPayment(array $data, array $expected)
    {
        $credit = new \App\Models\Credit(...$data);
        $payment = round((new AnnuityCalculator($credit))->getPercentDebtPayment(), 2);
        $this->assertEquals($expected['percentDebtPayment'], $payment);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testGetMainDebtPayment(array $data, array $expected)
    {
        $credit = new \App\Models\Credit(...$data);
        $payment = round((new AnnuityCalculator($credit))->getMainDebtPayment(), 2);
        $this->assertEquals($expected['mainDebtPayment'], $payment);
    }

    public function dataProvider(): array
    {
        return [
            [
                [0.1, 100000, 12, ''],
                ['monthlyPayment' => 8791.59, 'percentDebtPayment' => 833.33, 'mainDebtPayment' => 7958.26],
            ],
            [
                [0.2, 100000, 12, ''],
                ['monthlyPayment' => 9263.45, 'percentDebtPayment' => 1666.67, 'mainDebtPayment' => 7596.78],
            ],
            [
                [0.2, 150000, 12, ''],
                ['monthlyPayment' => 13895.18, 'percentDebtPayment' => 2500.0, 'mainDebtPayment' => 11395.18],
            ],
        ];
    }
}
