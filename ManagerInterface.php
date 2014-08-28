<?php

namespace Ekyna\Component\Characteristics;

use Ekyna\Component\Characteristics\Model\CharacteristicInterface;
use Ekyna\Component\Characteristics\Model\CharacteristicsInterface;
use Ekyna\Component\Characteristics\Schema\Definition;

/**
 * Interface ManagerInterface
 * @package Ekyna\Component\Characteristics
 */
interface ManagerInterface
{
    /**
     * Returns the metadata factory.
     *
     * @return \Metadata\MetadataFactoryInterface
     */
    public function getMetadataFactory();

    /**
     * Returns the schema registry.
     *
     * @return \Ekyna\Component\Characteristics\Schema\SchemaRegistryInterface
     */
    public function getSchemaRegistry();

    /**
     * Returns the schema for the given class.
     *
     * @param mixed $objectOrClass
     *
     * @return \Ekyna\Component\Characteristics\Schema\Schema
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function getSchemaForClass($objectOrClass);

    /**
     * Returns the inherit property path for the given class.
     *
     * @param mixed $objectOrClass
     *
     * @return string|null
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function getInheritPathForClass($objectOrClass);

    /**
     * Returns characteristic's inherited datas.
     *
     * @param CharacteristicsInterface $characteristics
     *
     * @return CharacteristicsInterface|null
     */
    public function getInheritedCharacteristics(CharacteristicsInterface $characteristics);

    /**
     * Creates and returns a characteristics view.
     *
     * @param \Ekyna\Component\Characteristics\Model\CharacteristicsInterface $characteristics
     *
     * @return \Ekyna\Component\Characteristics\View\View
     */
    public function createView(CharacteristicsInterface $characteristics);

    /**
     * Builds the value of the given characteristic.
     *
     * @param \Ekyna\Component\Characteristics\Model\CharacteristicInterface $characteristic
     * @param \Ekyna\Component\Characteristics\Schema\Definition $definition
     *
     * @return string
     */
    public function buildCharacteristicValue(CharacteristicInterface $characteristic, Definition $definition);

    /**
     * Creates an returns a characteristic from a definition.
     *
     * @param \Ekyna\Component\Characteristics\Schema\Definition $definition
     *
     * @return \Ekyna\Component\Characteristics\Model\CharacteristicInterface
     *
     * @throws \InvalidArgumentException
     */
    public function createCharacteristicFromDefinition(Definition $definition);
} 