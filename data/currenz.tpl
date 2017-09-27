<?php
declare(strict_types=1);
namespace Thunder\Currenz;

<USES>

final class Currenz
{
    public static function createFromCode(string $code): CurrencyInterface
    {
        if(false === array_key_exists($code, static::$iso)) {
            throw new \OutOfRangeException(sprintf('There is no currency with code %s!', $code));
        }

        return static::{$code === 'TRY' ? $code.'_' : $code}();
    }

    public static function __callStatic(string $name, array $arguments)
    {
        throw new \OutOfRangeException(sprintf('There is no currency with code %s!', $name));
    }

<NAMED>

    private static $iso = <CURRENCIES>;
}
