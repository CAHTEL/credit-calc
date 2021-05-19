<?php

use App\Calculators\DifferentialCalculator;
use PHPUnit\Framework\TestCase;

class DifferentialCalculatorTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testGetMonthlyPayment(array $data, array $expected)
    {
        $credit = new \App\Models\Credit(...$data);
        $payment = round((new DifferentialCalculator($credit))->getMonthlyPayment(), 2);
        $this->assertEquals($expected['monthlyPayment'], $payment);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testGetPercentDebtPayment(array $data, array $expected)
    {
        $credit = new \App\Models\Credit(...$data);
        $payment = round((new DifferentialCalculator($credit))->getPercentDebtPayment(), 2);
        $this->assertEquals($expected['percentDebtPayment'], $payment);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testGetMainDebtPayment(array $data, array $expected)
    {
        $credit = new \App\Models\Credit(...$data);
        $payment = round((new DifferentialCalculator($credit))->getMainDebtPayment(), 2);
        $this->assertEquals($expected['mainDebtPayment'], $payment);
    }

    public function dataProvider(): array
    {
        return [
            [
                [0.1, 100000, 12, ''],
                ['monthlyPayment' => 9166.67, 'percentDebtPayment' => 833.33, 'mainDebtPayment' => 8333.33],
            ],
            [
                [0.2, 100000, 12, ''],
                ['monthlyPayment' => 10000.0, 'percentDebtPayment' => 1666.67, 'mainDebtPayment' => 8333.33],
            ],
            [
                [0.2, 150000, 12, ''],
                ['monthlyPayment' => 15000, 'percentDebtPayment' => 2500.0, 'mainDebtPayment' => 12500.0],
            ],
        ];
    }
}
