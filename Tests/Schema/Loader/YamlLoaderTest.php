<?php

namespace Ekyna\Component\Characteristics\Tests\Schema\Loader;

use Ekyna\Component\Characteristics\Schema\Loader\YamlLoader;

/**
 * Class YamlLoaderTest
 * @package Ekyna\Component\Characteristics\Tests\Schema\Loader
 */
class YamlLoaderTest extends AbstractLoaderTest
{
    /**
     * @var YamlLoader
     */
    private $loader;

    public function setUp()
    {
        $this->loader = new YamlLoader();
    }

    public function tearDown()
    {
        $this->loader = null;
    }

    public function loadSchemas()
    {
        return $this->loader->load(__DIR__.'/../../Fixtures/config/schemas.yml');
    }
} 