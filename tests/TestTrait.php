<?php
declare(strict_types=1);
namespace Thunder\Currenz\Tests;

use PHPUnit\Framework\TestCase;
use Thunder\Currenz\CurrencyInterface;

trait TestTrait
{
    private function assertCurrency(CurrencyInterface $currency, string $code, string $name, array $countries, ?int $digits, string $number)
    {
        /** @var TestCase $this */
        $this->assertSame($number, $currency->getNumber(), 'ID ('.$code.')');
        $this->assertSame($code, $currency->getCode(), 'Code');
        $this->assertSame($digits, $currency->getDigits(), 'Digits');
        $this->assertSame($name, $currency->getName(), 'Name');
        $this->assertSame($countries, $currency->getCountries(), 'Country');

        $this->assertTrue($currency->hasCode($code));
        $this->assertTrue($currency->hasCountry($countries[0]));
        $this->assertTrue($currency->hasName($name));
        $this->assertTrue($currency->hasNumber($number));

        $this->assertFalse($currency->hasCode('INVALID'));
        $this->assertFalse($currency->hasCountry('INVALID'));
        $this->assertFalse($currency->hasName('INVALID'));
        $this->assertFalse($currency->hasNumber('INVALID'));

        switch($currency->getDigits()) {
            case null: { $this->assertSame(0, $currency->getUnits()); break; }
            case 0: { $this->assertSame(0, $currency->getUnits()); break; }
            case 1: { $this->assertSame(10, $currency->getUnits()); break; }
            case 2: { $this->assertSame(100, $currency->getUnits()); break; }
            case 3: { $this->assertSame(1000, $currency->getUnits()); break; }
            case 4: { $this->assertSame(10000, $currency->getUnits()); break; }
            default: { throw new \OutOfRangeException(sprintf('Invalid number of currency digits: %s!', $currency->getDigits())); }
        }
    }
}
