<?php

namespace Ekyna\Component\Characteristics\Tests;

use Ekyna\Component\Characteristics\Manager;
use Ekyna\Component\Characteristics\ManagerBuilder;
use Ekyna\Component\Characteristics\Schema\Registry;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class ManagerTest
 * @package Ekyna\Component\Characteristics\Tests
 */
class ManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Manager
     */
    private $manager;

    /**
     * @var Filesystem
     */
    private $fs;

    /**
     * @var string
     */
    private $tmpDir;

    public function setUp()
    {
        $this->tmpDir = sys_get_temp_dir() . '/characteristics';
        $this->fs = new Filesystem();
        $this->fs->remove($this->tmpDir);
        clearstatcache();

        $builder = ManagerBuilder::create();

        $this->manager = $builder
            ->setSchemaDirs([__DIR__ . '/Fixtures/config'])
            ->setMetadataDirs([])
            ->setCacheDir($this->tmpDir)
            ->build();
    }

    public function tearDown()
    {
        $this->manager = null;
        $this->fs->remove($this->tmpDir);
    }

    public function testGetSchemaForClass()
    {
        $productSchema = $this->manager->getSchemaForClass('Ekyna\Component\Characteristics\Tests\Fixtures\ProductCharacteristics');
        $this->assertEquals('product', $productSchema->getName());

        $productSchema = $this->manager->getSchemaForClass('Ekyna\Component\Characteristics\Tests\Fixtures\VariantCharacteristics');
        $this->assertEquals('product', $productSchema->getName());
    }
}
