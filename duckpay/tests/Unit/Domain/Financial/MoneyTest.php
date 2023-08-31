<?php

namespace Tests\Unit\Domain\Financial;

use App\Domain\Financial\Money;
use JetBrains\PhpStorm\ArrayShape;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    /**
     * @param $dataMoney
     * @param $moneyResult
     * @return void
     * @dataProvider data_provider_create_money
     */
    public function test_create_money($dataMoney, $moneyResult): void
    {
        $money = new Money($dataMoney);
        $this->assertEquals($moneyResult, $money->value(), "Internal error instance");
    }

    /**
     * @param $moneySum1
     * @param $moneySum2
     * @param $moneyResult
     * @return void
     * @dataProvider data_provider_sum_money
     */
    public function test_sum_money($moneySum1, $moneySum2, $moneyResult): void
    {
        $money = new Money($moneySum1);
        $money->add($moneySum2);
        $result = $money->value();
        $this->assertEquals($moneyResult,$result);
    }

    /**
     * @param $moneySub1
     * @param $moneySub2
     * @param $moneyResult
     * @return void
     * @dataProvider data_provider_sub_money
     */
    public function test_sub_money($moneySub1, $moneySub2, $moneyResult): void
    {
        $money = new Money($moneySub1);
        $money->sub($moneySub2);
        $result = $money->value();
        $this->assertEquals($moneyResult,$result);
    }

    /**
     * @return array
     */
    public static function data_provider_create_money(): array
    {
        return [
            "Number without point" =>
                [
                    3000, 3000.00,
                ],
            "Number with point" =>
                [
                    30.00, 30.00,
                ],
            "String without point" =>
                [
                    '4000', '4000.00',
                ],
            "String with point" =>
                [
                    '40.00', '40.00',
                ],
            "String with comma" =>
                [
                    '40,00', '40.00',
                ],
            "String '*,***.**'" =>
                [
                    '1,040.00', '1040.00',
                ],
            "String 'R$ *,***.**'" =>
                [
                    'R$ 1,040.00', '1040.00',
                ],
            "String '*.***,**'" =>
                [
                    '1.040,00', '1040.00',
                ],
            "String '*,**'" =>
                [
                    '15,0', '15.00',
                ],
        ];
    }

    /**
     * @return array
     */
    public static function data_provider_sum_money(): array
    {
        return [
            "Number without point" =>
                [
                    3030, 3130, 6160.00,
                ],
            "Number with point" =>
                [
                    30.60, 43.20, 73.80,
                ],
            "String without point" =>
                [
                    '3030', '3130', '6160.00',
                ],
            "String with point" =>
                [
                    '30.60', '43.20', '73.80',
                ],
            "String with comma" =>
                [
                    '30,60', '43,20', '73.80',
                ],
        ];
    }

    /**
     * @return array
     */
    public static function data_provider_sub_money(): array
    {
        return [
            "Number without point" =>
                [
                    3030, 3130, -100.00,
                ],
            "Number with point" =>
                [
                    30.60, 43.20, -12.60,
                ],
            "String without point" =>
                [
                    '3030', '3130', '-100.00',
                ],
            "String with point" =>
                [
                    '30.60', '43.20', '-12.60',
                ],
            "String with comma" =>
                [
                    '30,60', '43,20', '-12.60',
                ],
        ];
    }
}
