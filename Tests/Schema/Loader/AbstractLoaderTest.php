<?php

namespace Ekyna\Component\Characteristics\Tests\Schema\Loader;

/**
 * Class AbstractLoaderTest
 * @package Ekyna\Component\Characteristics\Tests\Schema\Loader
 */
abstract class AbstractLoaderTest extends \PHPUnit_Framework_TestCase
{
    abstract public function loadSchemas();

    public function testLoad()
    {
        $schemas = $this->loadSchemas();

        $this->assertEquals(1, count($schemas));

        $productSchema = $schemas[0];
        $this->assertEquals('product', $productSchema->getName());
        $this->assertEquals('Produit', $productSchema->getTitle());

        $generalGroup = $productSchema->getGroupByName('general');
        $this->assertEquals('general', $generalGroup->getName());
        $this->assertEquals('Général', $generalGroup->getTitle());

        $referenceDefinition = $generalGroup->getDefinitionByName('reference');
        $this->assertEquals('reference', $referenceDefinition->getName());
        $this->assertEquals('product:general:reference', $referenceDefinition->getFullName());
        $this->assertEquals('Référence', $referenceDefinition->getTitle());
        $this->assertEquals('text', $referenceDefinition->getType());

        $colorDefinition = $generalGroup->getDefinitionByName('color');
        $this->assertEquals('color', $colorDefinition->getName());
        $this->assertEquals('product:general:color', $colorDefinition->getFullName());
        $this->assertEquals('Couleur', $colorDefinition->getTitle());
        $this->assertEquals('choice', $colorDefinition->getType());

        $sizeDefinition = $generalGroup->getDefinitionByName('size');
        $this->assertEquals('size', $sizeDefinition->getName());
        $this->assertEquals('product:general:size', $sizeDefinition->getFullName());
        $this->assertEquals('Taille de l\'écran', $sizeDefinition->getTitle());
        $this->assertEquals('number', $sizeDefinition->getType());

        $brandDefinition = $generalGroup->getDefinitionByName('brand');
        $this->assertEquals('brand', $brandDefinition->getName());
        $this->assertEquals('product:general:brand', $brandDefinition->getFullName());
        $this->assertEquals('Marque', $brandDefinition->getTitle());
        $this->assertEquals('text', $brandDefinition->getType());
        $this->assertEquals(array('product.brand.title'), $brandDefinition->getParameter('property_paths'));

        $networkGroup = $productSchema->getGroupByName('network');
        $this->assertEquals('network', $networkGroup->getName());
        $this->assertEquals('Réseaux', $networkGroup->getTitle());

        $wifiDefinition = $networkGroup->getDefinitionByName('wifi');
        $this->assertEquals('wifi', $wifiDefinition->getName());
        $this->assertEquals('product:network:wifi', $wifiDefinition->getFullName());
        $this->assertEquals('WiFi', $wifiDefinition->getTitle());
        $this->assertEquals('boolean', $wifiDefinition->getType());
    }
}
