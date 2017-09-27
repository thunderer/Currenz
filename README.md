# Currenz

[![Build Status](https://travis-ci.org/thunderer/Currenz.png?branch=master)](https://travis-ci.org/thunderer/Currenz)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/5f66de38-a0cd-4ea7-8432-066963b8b287/mini.png)](https://insight.sensiolabs.com/projects/5f66de38-a0cd-4ea7-8432-066963b8b287)
[![License](https://poser.pugx.org/thunderer/currenz/license.svg)](https://packagist.org/packages/thunderer/currenz)
[![Latest Stable Version](https://poser.pugx.org/thunderer/currenz/v/stable.svg)](https://packagist.org/packages/thunderer/currenz)
[![Total Downloads](https://poser.pugx.org/thunderer/currenz/downloads)](https://packagist.org/packages/thunderer/currenz)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/thunderer/Currenz/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/thunderer/Currenz/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/thunderer/Currenz/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/thunderer/Currenz/?branch=master)

Currenz is a small and easy to use utility library providing currency value objects for all currencies defined in [ISO4217:2015](https://www.iso.org/iso-4217-currency-codes.html). You can read more about the standard on [Wikipedia](https://en.wikipedia.org/wiki/ISO_4217).

## Installation

This library is [available on Packagist](https://packagist.org/packages/thunderer/currenz) as `thunderer/currenz`. It can be installed using Composer by executing following command in the project directory:

```
composer require thunderer/currenz=^0.1
```

## Usage

Every currency has its own dedicated class and implements a common interface. There are multiple ways of creating an instance of given currency class using its three-letter code:

```php
use Thunder\Currenz\Currency\PLN;
use Thunder\Currenz\Currency\USD;

$usd = new USD();
$usd = Currenz::USD();
$usd = Currenz::createFromCode('USD');

$pln = new PLN();
$pln = Currenz::PLN();
$pln = Currenz::createFromCode('PLN');
```

Following methods can be called to extract desired information from currency object:

```php
assert('PLN' === $pln->getCode()); // ISO4217 currency code
assert('Zloty' === $pln->getName()); // regular name
assert(2 === $pln->getDigits()); // number of decimal places
assert(100 === $pln->getUnits()); // number of base units
assert(['POLAND'] === $pln->getCountries()); // list of countries where it is used
assert('985' === $pln->getNumber()); // ISO4217 currency number
```

## Binaries

There are two executable scripts included in the code of this library:

- `bin/generate` generates `Currenz` class from data in `data/list_one.xml`. It should be used in Composer's `post-install` and `post-update` hooks,
- `bin/summary` shows all information from that file in an easy to read tabular view.

## Notes

### ISO4217 data files

Following ISO4217 data files downloaded from the standard's website are included in `data` directory in this repository:

- `list_one.xml`: list of currencies in active usage, this file is used to generate all classes in `bin/generate` script,
- `list_one.xls`: the same data in XLS format,
- `list_two.doc`: information about maintenance agency registered fund codes in DOC format,
- `list_three.xml`: list of historical currencies removed from the current version of the standard,
- `list_three.xls`: the same data in XLS format,
- `overview_amendments.xlsx`: list of standard's amendments,
- `schema.xsd`: standard's XSD schema for included XML files.

### Non-decimal currencies

There are currencies called `non-decimal`, which means that their [base units are not powers of 10](https://en.wikipedia.org/wiki/Non-decimal_currency). Their value is so low that they are usually omitted. Currently there are two of them:

- Mauritania 1 ouguiya (UM) = 5 khoums,
- Madagascar 1 ariary = 5 iraimbilanja.

This library strictly follows ISO4217 standard so both of them will appear as currencies with 100 base units (10^2).
