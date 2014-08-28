<?php

namespace Ekyna\Component\Characteristics\Tests\Metadata\Driver;

use Ekyna\Component\Characteristics\Metadata\ClassMetadata;

/**
 * Class BaseDriverTest
 * @package Ekyna\Component\Characteristics\Tests\Metadata\Driver
 */
abstract class BaseDriverTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadProductMetadata()
    {
        $r = new \ReflectionClass('Ekyna\Component\Characteristics\Tests\Fixtures\ProductCharacteristics');
        $m = $this->getDriver()->loadMetadataForClass($r);

        $this->assertNotNull($m);

        $c = new ClassMetadata('Ekyna\Component\Characteristics\Tests\Fixtures\ProductCharacteristics');
        $c->fileResources[] = $r->getFileName();
        $c->schema = 'product';
        $c->inherit = null;
        $this->assertEquals($c, $m);
    }

    public function testLoadVariantMetadata()
    {
        $r = new \ReflectionClass('Ekyna\Component\Characteristics\Tests\Fixtures\VariantCharacteristics');
        $m = $this->getDriver()->loadMetadataForClass($r);

        $this->assertNotNull($m);

        $c = new ClassMetadata('Ekyna\Component\Characteristics\Tests\Fixtures\VariantCharacteristics');
        $c->fileResources[] = $r->getFileName();
        $c->schema = 'product';
        $c->inherit = 'variant.product.characteristics';
        $this->assertEquals($c, $m);
    }

    /**
     * @return \Metadata\Driver\DriverInterface
     */
    abstract protected function getDriver();
}
