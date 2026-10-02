<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class InvoiceRequestCalculationTest extends TestCase
{
    /**
     * A basic unit test example.
     */
//     public function test_invoice_total_allows_small_rounding_difference(): void
// {
//     $givenTotal = 102.02;
//     $consultation = 80.01;
//     $medicines = 20;
//     $discount = 0;
//     $tax = 2;
    
//     $expected = round($consultation + $medicines - $discount + $tax, 2);
    
   
//     $this->assertTrue(abs($expected - $givenTotal) <= 0.01);
// }
// public function test_invoice_total_fails_when_difference_exceeds_tolerance(): void
// {
//     $givenTotal = 102.05; 
//     $consultation = 80.01;
//     $medicines = 20;
//     $discount = 0;
//     $tax = 2;
    
//     $expected = round($consultation + $medicines - $discount + $tax, 2);
    
//     $this->assertFalse(abs($expected - $givenTotal) <= 0.01);
// }

public static function invoiceTotalsProvider(): array
{
    return [
        'small difference allowed'    => [102.02, 80.01, 20, 0, 2, true],
        'large difference not allowed' => [102.05, 80.01, 20, 0, 2, false],
        'exact match'                  => [102.01, 80.01, 20, 0, 2, true],
    ];
}

/**
 * @dataProvider invoiceTotalsProvider
 */
public function test_invoice_total_validation(
    float $givenTotal,
    float $consultation,
    float $medicines,
    float $discount,
    float $tax,
    bool $shouldPass
): void
 {
    $expected = round($consultation + $medicines - $discount + $tax, 2);
    $result = abs($expected - $givenTotal) <= 0.01;
    $this->assertEquals($shouldPass, $result);
}
}
