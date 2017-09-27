<?php
namespace Thunder\Currenz;

interface CurrencyInterface
{
    /**
     * @return string The currency name: Zloty, Dollar, etc.
     */
    public function getName(): string;

    /**
     * @return string Currency ISO4217 three-letter code: PLN, USD, etc.
     */
    public function getCode(): string;

    /**
     * @return int|null The number of decimal places, ie. 2 for 100, 3 for 100m etc. Null may be returned for currencies that do not support base units.
     */
    public function getDigits(): ?int;

    /**
     * @return int The number of base units, ie. 100 for PLN which has two digits.
     */
    public function getUnits(): int;

    /**
     * @return string[] List of names of countries where given currency is used: PLN is used in Poland.
     */
    public function getCountries(): array;

    /**
     * @return string ISO4217 currency numeric identifier, 985 for PLN.
     */
    public function getNumber(): string;

    public function hasName(string $name): bool;

    public function hasCode(string $code): bool;

    public function hasCountry(string $code): bool;

    public function hasNumber(string $number): bool;
}
