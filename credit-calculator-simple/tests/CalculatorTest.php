<?php


use App\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    /**
     * @dataProvider annuityDataProvider
     * @param array $data
     * @param array $expected
     */
    public function testCalculateForAnnuityPayment(array $data, array $expected)
    {
        $calculator = new App\Calculator();
        $paymentInfo = $calculator->calculateForAnnuityPayment(...$data);
        $this->assertEquals($expected['monthlyPayment'], round($paymentInfo['monthlyPayment'], 2));
        $this->assertEquals($expected['percentPart'], round($paymentInfo['percentPart'], 2));
        $this->assertEquals($expected['mainDebtPart'], round($paymentInfo['mainDebtPart'], 2));
        $this->assertEquals($expected['debt'], round($paymentInfo['debt'], 2));
    }

    /**
     * @dataProvider allPeriodDataProvider
     * @param array $data
     * @param array $expected
     */
    public function testCalculateForAllPeriod(array $data, array $expected)
    {
        $calculator = new App\Calculator();
        $payments = $calculator->calculateForAllPeriod(...$data);
        $this->assertEquals($expected, $payments);
    }

    /**
     * @dataProvider differentialDataProvider
     * @param array $data
     * @param array $expected
     */
    public function testCalculateForDifferentialPayment(array $data, array $expected)
    {
        $calculator = new App\Calculator();
        $paymentInfo = $calculator->calculateForDifferentialPayment(...$data);

        $this->assertEquals($expected['monthlyPayment'], round($paymentInfo['monthlyPayment'], 2));
        $this->assertEquals($expected['percentPart'], round($paymentInfo['percentPart'], 2));
        $this->assertEquals($expected['mainDebtPart'], round($paymentInfo['mainDebtPart'], 2));
        $this->assertEquals($expected['debt'], round($paymentInfo['debt'], 2));
    }

    public function annuityDataProvider(): array
    {
        return [
            [
                [0.1, 100000, 12, 100000, 0],
                ['monthlyPayment' => 8791.59, 'percentPart' => 833.33, 'mainDebtPart' => 7958.26, 'debt' => 92041.74],
            ],
            [
                [0.2, 100000, 12, 100000, 0],
                ['monthlyPayment' => 9263.45, 'percentPart' => 1666.67, 'mainDebtPart' => 7596.78, 'debt' => 92403.22],
            ],
            [
                [0.2, 150000, 12, 150000, 0],
                ['monthlyPayment' => 13895.18, 'percentPart' => 2500.0, 'mainDebtPart' => 11395.18, 'debt' => 138604.82],
            ],
        ];
    }

    public function differentialDataProvider(): array
    {
        return [
            [
                [0.1, 100000, 12, 100000, 0],
                ['monthlyPayment' => 9166.67, 'percentPart' => 833.33, 'mainDebtPart' => 8333.33, 'debt' => 91666.67],
            ],
            [
                [0.2, 100000, 12, 100000, 0],
                ['monthlyPayment' => 10000.0, 'percentPart' => 1666.67, 'mainDebtPart' => 8333.33, 'debt' => 91666.67],
            ],
            [
                [0.2, 150000, 12, 150000, 0],
                ['monthlyPayment' => 15000, 'percentPart' => 2500.0, 'mainDebtPart' => 12500.0, 'debt' => 137500.00],
            ],
        ];
    }

    public function allPeriodDataProvider(): array
    {
        return [
            [
                [0.12, 120000, 3, 'diff'],
                [
                    ['monthlyPayment' => 41200.0, 'percentPart' => 1200.0, 'mainDebtPart' => 40000.0, 'debt' => 80000.0],
                    ['monthlyPayment' => 40800.0, 'percentPart' => 800.0, 'mainDebtPart' => 40000.0, 'debt' => 40000.0],
                    ['monthlyPayment' => 40400.0, 'percentPart' => 400.0, 'mainDebtPart' => 40000.0, 'debt' => 0.0],
                ]
            ],
        ];
    }
}

