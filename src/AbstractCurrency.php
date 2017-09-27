<?php
declare(strict_types=1);
namespace Thunder\Currenz;

use Prophecy\Exception\InvalidArgumentException;

abstract class AbstractCurrency implements CurrencyInterface
{
    private $name;
    private $code;
    private $digits;
    private $countries;
    private $number;

    public function __construct(string $name, string $code, ?int $digits, array $countries, string $number)
    {
        if(empty($name)) {
            throw new \InvalidArgumentException('Currency name must not be empty!');
        }
        if(!preg_match('~^[A-Z]{3}$~', $code)) {
            throw new \InvalidArgumentException(sprintf('ISO4217 currency code must be an uppercase three-letter string, `%s` given!', $code));
        }
        if($digits !== null && $digits < 0) {
            throw new \InvalidArgumentException(sprintf('Currency digits must be a non-negative integer or null, `%s` given!', $digits));
        }
        foreach($countries as $country) {
            if(false === is_string($country)) {
                throw new InvalidArgumentException('Currency country name must be a string!');
            }
            if(empty($country)) {
                throw new \InvalidArgumentException('Currency country name must not be empty!');
            }
        }
        if(!preg_match('~^[0-9]{3}$~', $number)) {
            throw new \InvalidArgumentException(sprintf('ISO4217 currency number must be a three-digit string, `%s` given!', $number));
        }

        $this->name = $name;
        $this->code = $code;
        $this->digits = $digits;
        $this->countries = $countries;
        $this->number = $number;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getDigits(): ?int
    {
        return $this->digits;
    }

    public function getUnits(): int
    {
        return null === $this->digits || 0 === $this->digits ? 0 : 10 ** $this->digits;
    }

    public function getCountries(): array
    {
        return $this->countries;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function hasName(string $name): bool
    {
        return $this->name === $name;
    }

    public function hasCode(string $code): bool
    {
        return $this->code === $code;
    }

    public function hasCountry(string $country): bool
    {
        return in_array($country, $this->countries, true);
    }

    public function hasNumber(string $number): bool
    {
        return $this->number === $number;
    }
}
