<?php
declare(strict_types=1);
namespace Thunder\Currenz\Tests;

use PHPUnit\Framework\TestCase;
use Thunder\Currenz\Currency;
use Thunder\Currenz\Currenz;
use Thunder\Currenz\Utility\Utility;

final class CurrenzTest extends TestCase
{
    use TestTrait;

    /**
     * @dataProvider provideCurrencies
     */
    public function testCurrencies(string $code, string $name, array $countries, ?int $digits, string $id)
    {
        $this->assertCurrency(Currenz::{$code === 'TRY' ? $code.'_' : $code}(), $code, $name, $countries, $digits, $id);
    }

    /**
     * @dataProvider provideCurrencies
     */
    public function testClasses(string $code, string $name, array $countries, ?int $digits, string $id)
    {
        $class = 'Thunder\\Currenz\\Currency\\'.($code === 'TRY' ? $code.'_' : $code);

        $this->assertCurrency(new $class(), $code, $name, $countries, $digits, $id);
    }

    /**
     * @dataProvider provideCurrencies
     */
    public function testFromCode(string $code, string $name, array $countries, ?int $digits, string $id)
    {
        $this->assertCurrency(Currenz::createFromCode($code), $code, $name, $countries, $digits, $id);
    }

    public function provideCurrencies()
    {
        return array_filter(array_map(function(array $item) {
            return $item['code'] ? [$item['code'], $item['name'], $item['countries'], $item['units'] === 'N.A.' ? null : (int)$item['units'], $item['id']] : null;
        }, Utility::xmlToArray(file_get_contents(__DIR__.'/../data/list_one.xml'))));
    }

    public function testSpecificCurrency()
    {
        $this->assertCurrency(new Currency\PLN(), 'PLN', 'Zloty', ['POLAND'], 2, '985');
        $this->assertCurrency(Currenz::PLN(), 'PLN', 'Zloty', ['POLAND'], 2, '985');
        $this->assertCurrency(Currenz::createFromCode('PLN'), 'PLN', 'Zloty', ['POLAND'], 2, '985');
    }

    public function testInvalidCodeException()
    {
        $this->expectException(\OutOfRangeException::class);
        Currenz::ZZZ();
    }

    public function testInvalidCodeInNamedConstructorException()
    {
        $this->expectException(\OutOfRangeException::class);
        Currenz::createFromCode('ZZZ');
    }
}
