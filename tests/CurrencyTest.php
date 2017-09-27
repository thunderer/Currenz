<?php
declare(strict_types=1);
namespace Thunder\Currenz\Tests;

use PHPUnit\Framework\TestCase;
use Thunder\Currenz\Currency;

final class CurrencyTest extends TestCase
{
    use TestTrait;

    public function testCurrency()
    {
        $this->assertCurrency(new Currency('NAME', 'COD', 2, ['RANDOM'], '128'), 'COD', 'NAME', ['RANDOM'], 2, '128');
    }

    public function testExceptionWhenEmptyName()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Currency('', 'COD', 2, ['RANDOM'], '128');
    }

    public function testExceptionWhenInvalidCode()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Currency('NAME', 'CODE', 2, ['RANDOM'], '128');
    }

    public function testExceptionWhenEmptyCountryName()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Currency('NAME', 'COD', 2, [''], '128');
    }

    public function testExceptionWhenInvalidCountryName()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Currency('NAME', 'COD', 2, [null], '128');
    }

    public function testExceptionWhenNegativeDigits()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Currency('NAME', 'COD', -1, ['RANDOM'], '128');
    }

    public function testExceptionWhenEmptyNumber()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Currency('NAME', 'COD', 2, ['RANDOM'], 'A00');
    }
}
