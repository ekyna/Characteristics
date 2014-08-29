<?php

namespace Ekyna\Component\Characteristics;

use Ekyna\Component\Characteristics\Entity\BooleanCharacteristic;
use Ekyna\Component\Characteristics\Entity\ChoiceCharacteristic;
use Ekyna\Component\Characteristics\Entity\NumberCharacteristic;
use Ekyna\Component\Characteristics\Entity\TextCharacteristic;
use Ekyna\Component\Characteristics\Model\CharacteristicInterface;
use Ekyna\Component\Characteristics\Model\CharacteristicsInterface;
use Ekyna\Component\Characteristics\Schema\Definition;
use Ekyna\Component\Characteristics\Schema\SchemaRegistryInterface;
use Ekyna\Component\Characteristics\View\Entry;
use Ekyna\Component\Characteristics\View\Group;
use Ekyna\Component\Characteristics\View\View;
use Metadata\MetadataFactoryInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Class Manager
 * @package Ekyna\Component\Characteristics
 */
class Manager implements ManagerInterface
{
    /**
     * @var \Metadata\MetadataFactoryInterface
     */
    private $metadataFactory;

    /**
     * @var \Ekyna\Component\Characteristics\Schema\SchemaRegistryInterface
     */
    private $schemaRegistry;

    /**
     * Constructor.
     *
     * @param \Metadata\MetadataFactoryInterface $metadataFactory
     * @param \Ekyna\Component\Characteristics\Schema\SchemaRegistryInterface $schemaRegistry
     */
    public function __construct(MetadataFactoryInterface $metadataFactory, SchemaRegistryInterface $schemaRegistry)
    {
        $this->metadataFactory = $metadataFactory;
        $this->schemaRegistry = $schemaRegistry;
    }

    /**
     * {@inheritDoc}
     */
    public function getMetadataFactory()
    {
        return $this->metadataFactory;
    }

    /**
     * {@inheritDoc}
     */
    public function getSchemaRegistry()
    {
        return $this->schemaRegistry;
    }

    /**
     * {@inheritDoc}
     */
    public function getSchemaForClass($objectOrClass)
    {
        $class = is_object($objectOrClass) ? get_class($objectOrClass) : $objectOrClass;
        if (!is_string($class)) {
            throw new \InvalidArgumentException('Expected object or string.');
        }

        if (null === $m = $this->metadataFactory->getMetadataForClass($class)) {
            throw new \RuntimeException(sprintf('No characteristics metadata found for class "%s".', $class));
        }

        if (null === $m->schema) {
            throw new \InvalidArgumentException(sprintf('No schema specified for class "%s".', $class));
        }

        return $this->schemaRegistry->getSchemaByName($m->schema);
    }

    /**
     * {@inheritDoc}
     */
    public function getInheritPathForClass($objectOrClass)
    {
        $class = is_object($objectOrClass) ? get_class($objectOrClass) : $objectOrClass;
        if (!is_string($class)) {
            throw new \InvalidArgumentException('Expected object or string.');
        }

        if (null === $m = $this->metadataFactory->getMetadataForClass($class)) {
            throw new \RuntimeException(sprintf('No characteristics metadata found for class "%s".', $class));
        }

        return $m->inherit;
    }

    /**
     * {@inheritDoc}
     */
    public function getInheritedCharacteristics(CharacteristicsInterface $characteristics)
    {
        $parentCharacteristics = null;
        if (null !== $inheritPath = $this->getInheritPathForClass($characteristics)) {
            $accessor = PropertyAccess::createPropertyAccessor();
            $parentCharacteristics = $accessor->getValue($characteristics, $inheritPath);
        }
        return $parentCharacteristics;
    }

    /**
     * {@inheritDoc}
     */
    public function createView(CharacteristicsInterface $characteristics)
    {
        $schema = $this->getSchemaForClass(get_class($characteristics));
        $parentCharacteristics = $this->getInheritedCharacteristics($characteristics);

        $view = new View();

        foreach ($schema->getGroups() as $schemaGroup) {
            $group = new Group($schemaGroup->getName(), $schemaGroup->getTitle());
            foreach ($schemaGroup->getDefinitions() as $definition) {
                $value = null;
                $inherited = false;
                if ($definition->getType() === 'virtual') {
                    $accessor = PropertyAccess::createPropertyAccessor();
                    try {
                        $value = $accessor->getValue($characteristics, $definition->getParameter('property_path'));
                    } catch (\Exception $e) {
                        $value = null;
                    }
                    if (null === $value && null !== $parentCharacteristics) {
                        try {
                            $value = $accessor->getValue($parentCharacteristics, $definition->getParameter('property_path'));
                        } catch (\Exception $e) {
                            $value = null;
                        }
                    }
                } else {
                    $characteristic = $characteristics->getCharacteristicByName($definition->getIdentifier());

                    if (null === $characteristic && null !== $parentCharacteristics) {
                        if (null !== $characteristic = $parentCharacteristics->getCharacteristicByName($definition->getIdentifier())) {
                            $inherited = true;
                        }
                    }

                    if (null !== $characteristic) {
                        $value = $characteristic->display($definition);
                    }
                }

                $entry = new Entry($definition, $value, $inherited);
                $group->entries[] = $entry;
            }
            $view->groups[] = $group;
        }

        return $view;
    }

    /**
     * {@inheritDoc}
     */
    public function buildCharacteristicValue(CharacteristicInterface $characteristic, Definition $definition)
    {
        // TODO
        return (string)$characteristic->getValue();
    }

    /**
     * {@inheritDoc}
     */
    public function createCharacteristicFromDefinition(Definition $definition)
    {
        $characteristic = null;

        // TODO characteristic classes map

        switch ($definition->getType()) {
            case 'text' :
                $characteristic = new TextCharacteristic();
                break;
            case 'number' :
                $characteristic = new NumberCharacteristic();
                break;
            case 'bool' :
                $characteristic = new BooleanCharacteristic();
                break;
            case 'choice' :
                $characteristic = new ChoiceCharacteristic();
                break;
            default :
                throw new \InvalidArgumentException(sprintf('Invalid type "%s".', $definition->getType()));
        }

        $characteristic->setName($definition->getName());

        return $characteristic;
    }
}
