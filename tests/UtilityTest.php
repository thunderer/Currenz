<?php
declare(strict_types=1);
namespace Thunder\Currenz\Tests;

use PHPUnit\Framework\TestCase;
use Thunder\Currenz\Utility\Utility;

final class UtilityTest extends TestCase
{
    public function testXmlToArray()
    {
        $this->assertCount(179, Utility::xmlToArray(file_get_contents(__DIR__.'/../data/list_one.xml')));
    }
}
